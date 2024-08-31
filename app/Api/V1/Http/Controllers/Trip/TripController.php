<?php

namespace App\Api\V1\Http\Controllers\Trip;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Exception\NotFoundException;
use App\Api\V1\Http\Requests\Trip\EndTripRequest;
use App\Api\V1\Http\Requests\Trip\LocationRequest;
use App\Api\V1\Http\Requests\Trip\StartTripFromSchoolRequest;
use App\Api\V1\Http\Requests\Trip\StartTripRequest;
use App\Api\V1\Http\Requests\Trip\TripRequest;
use App\Api\V1\Http\Requests\Trip\UpdateStudentArrivalRequest;
use App\Api\V1\Http\Resources\Trip\TripResource;
use App\Api\V1\Http\Resources\Trip\TripResourceCollection;
use App\Api\V1\Repositories\Trip\TripRepositoryInterface;
use App\Api\V1\Services\Trip\TripServiceInterface;
use App\Api\V1\Support\Response;
use App\Api\V1\Validate\Validator;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * @group Chuyến đi
 */
class TripController extends Controller
{
    use UseLog, Response;

    public function __construct(
        TripRepositoryInterface $repository,
        TripServiceInterface    $service
    )
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Chi tiết chuyến đi.
     *
     * API này cho phép truy xuất danh sách các chuyến đi liên quan đến nhân viên đang được xác thực,
     * có thể là tài xế hoặc người trông trẻ, dựa vào loại hợp đồng và các bộ lọc khác được chỉ định trong yêu cầu.
     *
     * Các trạng thái (status) của chuyến đi bao gồm:
     * - 1: Chuyến đi đã được lên kế hoạch
     * - 2: Chuyến đi đang diễn ra(hoạt động)
     * - 3: Chuyến đi đã hoàn thành
     * - 4: Chuyến đi đã bị hủy bỏ
     * - 5: Chuyến đi nghỉ lễ
     *
     * Buổi rước (session):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     *
     * Loại hợp đồng (type):
     * - 1: Cả đưa và đón (Both): Đưa học sinh tới trường và đón học sinh về nhà
     * - 2: Chỉ đón đi (PickUpOnly): Chỉ bao gồm đưa học sinh
     * - 3: Chỉ đón về (DropOffOnly): Chỉ bao gồm đón học sinh
     *
     * Trạng thái Chi tiết chuyến đi
     * - 1: Học sinh đã bỏ qua lượt đón
     * - 2: Học sinh đã xin nghỉ
     * - 3: Học sinh chưa được đón đi
     * - 4: Học sinh đã được đón đi
     * - 5: Học sinh đã tới trường
     * - 6: Học sinh chưa được đón về
     * - 7: Học sinh đã được đón về
     * - 8: Học sinh đã về tới nhà
     *
     * @authenticated
     * Ví dụ: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam  code string required Code của chuyến đi.
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Các chuyến đi đã được truy xuất thành công",
     *      "data": {
     *          "trips": [],
     *          "total": 10
     *      }
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Không thể truy xuất các chuyến đi",
     *      "data": []
     * }
     *
     * @return JsonResponse
     */
    public function show(string $code): JsonResponse
    {
        try {
            Validator::validateExistsByField($this->repository, 'code', $code);
            $response = $this->repository->findByField('code', $code);
            return $this->jsonResponseSuccess(new TripResource($response));
        } catch (NotFoundException $e) {
            $this->logError('Error show detail for trip Code: ' . $code, $e);
            return $this->jsonResponseError("Error show detail for trip Code: $code", 404);
        } catch (Exception $e) {
            $this->logError('Error show detail for trip ID', $e);
            return $this->jsonResponseError("Error show detail for trip ID: " . $e->getMessage(), 500);
        }
    }


    /**
     * Lấy danh sách các chuyến đi theo nhân viên (Tài xế,giám sinh).
     *
     * API này cho phép truy xuất danh sách các chuyến đi liên quan đến nhân viên đang được xác thực,
     * có thể là tài xế hoặc người trông trẻ, dựa vào loại hợp đồng và các bộ lọc khác được chỉ định trong yêu cầu.
     *
     * Các trạng thái (status) của chuyến đi bao gồm:
     * - 1: Chuyến đi đã được lên kế hoạch
     * - 2: Chuyến đi đang diễn ra(hoạt động)
     * - 3: Chuyến đi đã hoàn thành
     * - 4: Chuyến đi đã bị hủy bỏ
     * - 5: Chuyến đi nghỉ lễ
     *
     * Buổi rước (session):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     *
     * Loại hợp đồng (type):
     * - 2: Chỉ đón đi (PickUpOnly): Chỉ bao gồm đưa học sinh
     * - 3: Chỉ đón về (DropOffOnly): Chỉ bao gồm đón học sinh
     *
     * Trường học(school):
     * - arrival_time_at_school: Thời gian đưa tới trường
     * - time_off: Thời gian từ trường về
     *
     * @authenticated
     * Ví dụ: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @queryParam type int optional Loại hợp đồng của chuyến đi. Các giá trị: 1 (Cả hai), 2 (Chỉ đón đi), 3 (Chỉ đón về).
     * @queryParam status int optional Trạng thái của chuyến đi. Example: 1
     * @queryParam session int optional Buổi của chuyến đi. Example: 2
     * @queryParam page integer optional Trang hiện tại của kết quả phân trang. Mặc định là 1. Example: 1
     * @queryParam limit integer optional Số lượng kết quả trên mỗi trang. Mặc định là 10. Example: 10
     * @queryParam date string optional Ngày mà chuyến đi được thực hiện. Định dạng YYYY-MM-DD. Example: 2024-07-12
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Các chuyến đi đã được truy xuất thành công",
     *      "data": {
     *          "trips": [],
     *          "total": 10
     *      }
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Không thể truy xuất các chuyến đi",
     *      "data": []
     * }
     *
     * @param TripRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực.
     * @return JsonResponse
     */


    public function getTripsByStaff(TripRequest $request): JsonResponse
    {
        try {
            $response = $this->service->getTripsByStaff($request);
            return $this->jsonResponseSuccess(new TripResourceCollection($response));
        } catch (Exception $e) {
            $this->logError('Error fetching trips by contract type', $e);
            return $this->jsonResponseError('Unable to fetch trips: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Bắt đầu Chuyến đi
     *
     * Các trạng thái (status) của chuyến đi bao gồm:
     * - 1: Chuyến đi đã được lên kế hoạch
     * - 2: Chuyến đi đang diễn ra(hoạt động)
     * - 3: Chuyến đi đã hoàn thành
     * - 4: Chuyến đi đã bị hủy bỏ
     * - 5: Chuyến đi nghỉ lễ
     *
     * Buổi rước (session):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     *
     * Loại hợp đồng (type):
     * - 2: Chỉ đón đi (PickUpOnly): Chỉ bao gồm đưa học sinh
     * - 3: Chỉ đón về (DropOffOnly): Chỉ bao gồm đón học sinh
     *
     * @authenticated
     * Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID của Chuyến đi. Example: 1
     * @bodyParam current_address string required Địa chỉ hiện tại nơi học sinh đang có mặt. Example: "123 Đường ABC, Quận 1, TP. HCM"
     * @bodyParam current_lat float required Vĩ độ GPS của vị trí hiện tại. Example: 10.776889
     * @bodyParam current_lng float required Kinh độ GPS của vị trí hiện tại. Example: 106.700806
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "notifySuccess",
     *      "data": []
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "notifyError",
     *      "data": []
     * }
     *
     * @param StartTripRequest $request
     * @return JsonResponse
     */
    public function startTrip(StartTripRequest $request): JsonResponse
    {
        try {
            $response = $this->service->startTrip($request);
            return $this->jsonResponseSuccess(new TripResource($response));
        } catch (Exception $e) {
            $this->logError('Error starting the trip', $e);
            return $this->jsonResponseError('Failed to start the trip: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Cập nhật trạng thái bắt đầu chuyến đi từ trường trả học sinh về nhà (ÁP DỤNG CHUYẾN ĐI CÓ TYPE LÀ 2).
     *
     * API này cho phép cập nhật trạng thái học sinh trong một chuyến đi dựa trên các thông tin như địa chỉ hiện tại, vị trí GPS, và ảnh chụp tại đích đến.
     * Yêu cầu này đòi hỏi phải có ID chi tiết chuyến đi, ảnh chụp tại điểm đến, địa chỉ hiện tại và thông tin vị trí GPS.
     *
     * @authenticated
     * @param StartTripFromSchoolRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và các thông tin cụ thể về chuyến đi.
     *
     * @return JsonResponse
     * @bodyParam id integer required ID chuyến đi. Example: 7466
     * @bodyParam destination_photo file required Ảnh chụp tại điểm đến của học sinh. Must be an image file.
     * @bodyParam current_address string required Địa chỉ hiện tại nơi học sinh đang có mặt. Example: "123 Đường ABC, Quận 1, TP. HCM"
     * @bodyParam current_lat float required Vĩ độ GPS của vị trí hiện tại. Example: 10.776889
     * @bodyParam current_lng float required Kinh độ GPS của vị trí hiện tại. Example: 106.700806
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Trạng thái của học sinh đã được cập nhật thành công.",
     *      "data": {
     *          "trip_detail": {
     *              "id": 5,
     *              "destination_photo_url": "path/to/photo.jpg",
     *              "current_address": "123 Đường ABC, Quận 1, TP. HCM",
     *              "current_lat": 10.776889,
     *              "current_lng": 106.700806,
     *              "status": "arrived" // Hoặc "home" tùy vào trạng thái được cập nhật
     *          }
     *      }
     * }
     *
     * @response 404 {
     *      "status": 404,
     *      "message": "Không tìm thấy chi tiết chuyến đi",
     *      "data": []
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Lỗi khi cập nhật trạng thái học sinh",
     *      "data": []
     * }
     */
    public function startTripFromSchool(StartTripFromSchoolRequest $request): JsonResponse
    {
        try {
            $response = $this->service->startTripFromSchool($request);
            return $this->jsonResponseSuccess(new TripResource($response));
        } catch (Exception $e) {
            $this->logError('Error starting the trip from school', $e);
            return $this->jsonResponseError('Error starting the trip from school: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Hoàn thành Chuyến đi
     *
     * Các trạng thái (status) của chuyến đi bao gồm:
     * - 1: Chuyến đi đã được lên kế hoạch
     * - 2: Chuyến đi đang diễn ra(hoạt động)
     * - 3: Chuyến đi đã hoàn thành
     * - 4: Chuyến đi đã bị hủy bỏ
     * - 5: Chuyến đi nghỉ lễ
     *
     * Buổi rước (session):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     *
     * Loại hợp đồng (type):
     * - 2: Chỉ đón đi (PickUpOnly): Chỉ bao gồm đưa học sinh
     * - 3: Chỉ đón về (DropOffOnly): Chỉ bao gồm đón học sinh
     *
     * @authenticated
     * Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID của Chuyến đi. Example: 1
     * @bodyParam current_address string required Địa chỉ hiện tại nơi học sinh đang có mặt. Example: "123 Đường ABC, Quận 1, TP. HCM"
     * @bodyParam current_lat float required Vĩ độ GPS của vị trí hiện tại. Example: 10.776889
     * @bodyParam current_lng float required Kinh độ GPS của vị trí hiện tại. Example: 106.700806
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "notifySuccess",
     *      "data": []
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "notifyError",
     *      "data": []
     * }
     *
     * @param EndTripRequest $request
     * @return JsonResponse
     */
    public function endTrip(EndTripRequest $request): JsonResponse
    {
        try {
            $trip = $this->service->endTrip($request);
            return $this->jsonResponseSuccess(new TripResource($trip));
        } catch (Exception $e) {
            $this->logError('Error ending the trip', $e);
            return $this->jsonResponseError('Failed to end the trip: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Cập nhật trạng thái của học sinh là đã tới trường.
     *
     * API này cho phép cập nhật trạng thái học sinh trong một chuyến đi dựa trên các thông tin như địa chỉ hiện tại, vị trí GPS, và ảnh chụp tại đích đến.
     * Yêu cầu này đòi hỏi phải có ID chi tiết chuyến đi, ảnh chụp tại điểm đến, địa chỉ hiện tại và thông tin vị trí GPS.
     *
     * @authenticated
     * @param UpdateStudentArrivalRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và các thông tin cụ thể về chuyến đi.
     *
     * @return JsonResponse
     * @bodyParam id integer required ID chuyến đi. Example: 5
     * @bodyParam destination_photo file required Ảnh chụp tại điểm đến của học sinh. Must be an image file.
     * @bodyParam current_address string required Địa chỉ hiện tại nơi học sinh đang có mặt. Example: "123 Đường ABC, Quận 1, TP. HCM"
     * @bodyParam current_lat float required Vĩ độ GPS của vị trí hiện tại. Example: 10.776889
     * @bodyParam current_lng float required Kinh độ GPS của vị trí hiện tại. Example: 106.700806
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Trạng thái của học sinh đã được cập nhật thành công.",
     *      "data": {
     *          "trip_detail": {
     *              "id": 5,
     *              "destination_photo_url": "path/to/photo.jpg",
     *              "current_address": "123 Đường ABC, Quận 1, TP. HCM",
     *              "current_lat": 10.776889,
     *              "current_lng": 106.700806,
     *              "status": "arrived" // Hoặc "home" tùy vào trạng thái được cập nhật
     *          }
     *      }
     * }
     *
     * @response 404 {
     *      "status": 404,
     *      "message": "Không tìm thấy chi tiết chuyến đi",
     *      "data": []
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Lỗi khi cập nhật trạng thái học sinh",
     *      "data": []
     * }
     *
     */


    public function updateStudentArrivalSchool(UpdateStudentArrivalRequest $request): JsonResponse
    {
        try {
            $response = $this->service->updateStudentArrivalSchool($request);
            return $this->jsonResponseSuccess(new TripResource($response));
        } catch (Throwable $e) {
            $this->logError('Error updating student arrival status', $e);
            return $this->jsonResponseError('Lỗi khi cập nhật trạng thái học sinh: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Cập nhật vị trí hiện tại của chuyến đi.
     *
     * API này cho phép cập nhật vị trí hiện tại của chuyến đi dựa trên địa chỉ hiện tại và thông tin GPS.
     * Yêu cầu này đòi hỏi phải có ID của chuyến đi, địa chỉ hiện tại và tọa độ GPS.
     *
     * @authenticated
     * @param LocationRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và thông tin cần thiết để cập nhật vị trí.
     *
     * @return JsonResponse
     * @bodyParam id integer required ID chuyến đi. Phải tồn tại trong bảng `trips`. Example: 5
     * @bodyParam current_address string required Địa chỉ hiện tại nơi học sinh đang có mặt. Example: "123 Đường ABC, Quận 1, TP. HCM"
     * @bodyParam current_lat float required Vĩ độ GPS của vị trí hiện tại. Example: 10.776889
     * @bodyParam current_lng float required Kinh độ GPS của vị trí hiện tại. Example: 106.700806
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Vị trí chuyến đi đã được cập nhật thành công.",
     *      "data": {
     *          "trip_detail": {
     *              "id": 5,
     *              "current_address": "123 Đường ABC, Quận 1, TP. HCM",
     *              "current_lat": 10.776889,
     *              "current_lng": 106.700806
     *          }
     *      }
     * }
     *
     * @response 404 {
     *      "status": 404,
     *      "message": "Không tìm thấy chuyến đi",
     *      "data": []
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Lỗi khi cập nhật vị trí chuyến đi",
     *      "data": []
     * }
     */
    public function updateLocation(LocationRequest $request): JsonResponse {
        try {
            $response = $this->service->updateLocation($request);
            return $this->jsonResponseSuccess(new TripResource($response));
        } catch (Throwable $e) {
            $this->logError('Error updating trip location', $e);
            return $this->jsonResponseError('Lỗi khi cập nhật vị trí chuyến đi: ' . $e->getMessage(), 500);
        }
    }



}
