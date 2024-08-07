<?php

namespace App\Api\V1\Http\Controllers\TripDetail;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Trip\TripStudentRequest;
use App\Api\V1\Http\Requests\TripDetail\EndTripRequest;
use App\Api\V1\Http\Requests\TripDetail\NotifyParentOfArrivalRequest;
use App\Api\V1\Http\Requests\TripDetail\TripDetailRequest;
use App\Api\V1\Http\Resources\TripDetail\TripDetailResource;
use App\Api\V1\Repositories\TripDetail\TripDetailRepository;
use App\Api\V1\Services\TripDetail\TripDetailServiceInterface;
use App\Api\V1\Support\Response;
use App\Traits\UseLog;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * @group Chi tiết chuyến đi
 */
class TripDetailController extends Controller
{
    use UseLog, Response;

    public function __construct(
        TripDetailRepository       $repository,
        TripDetailServiceInterface $service

    )
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Thông báo Phụ Huynh về Việc xe sắp đến Đến đón/trả  Học Sinh.
     *
     * API này cho phép gửi thông báo đến phụ huynh khi học sinh đã đến địa điểm quy định.
     * Yêu cầu này đòi hỏi phải có ID chi tiết của chuyến đi và thông tin vị trí hiện tại.
     * @authenticated
     * Ví dụ xác thực: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID chi tiết chuyến đi cần thông báo. Example: 2
     * @bodyParam current_address string required Địa chỉ hiện tại nơi thực hiện check-in. Example: Sân bay quốc tế Tân Sơn Nhất, Đường Trường Sơn, Tân Bình, Hồ Chí Minh, Việt Nam.
     * @bodyParam current_lat float required Vĩ độ của vị trí check-in hiện tại. Example: 10.815832
     * @bodyParam current_lng float required Kinh độ của vị trí check-in hiện tại. Example: 106.664132
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thông báo đã được gửi đến phụ huynh thành công",
     *      "data": []
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
     *      "message": "Lỗi khi gửi thông báo đến phụ huynh",
     *      "data": []
     * }
     *
     * @param NotifyParentOfArrivalRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và các thông tin về chuyến đi.
     * @return JsonResponse
     */
    public function notifyParentOfArrival(NotifyParentOfArrivalRequest $request): JsonResponse
    {
        try {
            $this->service->notifyParentOfArrival($request);
            return $this->jsonResponseSuccess(self::$EMPTY_ARRAY);
        } catch (Throwable $e) {
            $this->logError('Error notify to parent', $e);
            return $this->jsonResponseError('Error notify to parent: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Thông báo Phụ Huynh về kết thúc chuyến đi để ra đón học sinh về nhà (Kết thúc/Hoàn thành).
     *
     * API này cho phép đánh dấu một chuyến đi như đã kết thúc và gửi thông báo đến các phụ huynh rằng học sinh đã về đến điểm đón cuối cùng.
     * Yêu cầu này đòi hỏi phải có ID chi tiết của chuyến đi và thông tin vị trí hiện tại của xe.
     * @authenticated
     * Ví dụ xác thực: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID chi tiết chuyến đi cần kết thúc. Example: 2
     * @bodyParam current_address string required Địa chỉ hiện tại của xe khi kết thúc chuyến đi. Example: Trường tiểu học A, Đường B, Quận C, TP. HCM
     * @bodyParam current_lat float required Vĩ độ của vị trí kết thúc chuyến đi. Example: 10.776889
     * @bodyParam current_lng float required Kinh độ của vị trí kết thúc chuyến đi. Example: 106.700806
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Chuyến đi đã được kết thúc thành công và thông báo đã được gửi đến phụ huynh",
     *      "data": {
     *          "trip_id": 2,
     *          "end_time": "2024-07-17T13:00:00Z",
     *          "location": "Trường tiểu học A, Đường B, Quận C, TP. HCM"
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
     *      "message": "Lỗi khi kết thúc chuyến đi",
     *      "data": []
     * }
     *
     * @param EndTripRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và các thông tin về chuyến đi.
     * @return JsonResponse
     */
    public function endTrip(EndTripRequest $request): JsonResponse
    {
        try {
            $response = $this->service->endTrip($request);
            return $this->jsonResponseSuccess(new TripDetailResource($response));
        } catch (Throwable $e) {
            $this->logError('Error ending the trip', $e);
            return $this->jsonResponseError('Unable to end the trip: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Cập nhật trạng thái check-in(đón) của học sinh (Giám sinh cập nhật).
     *
     * API này cho phép cập nhật trạng thái đã đón (check-in) của học sinh trong một chuyến đi.
     * Yêu cầu này đòi hỏi phải có ID chi tiết của chuyến đi và hình ảnh của học sinh.
     * Và token của giám sinh
     *
     * Các trạng thái (picked_up) của chuyến đi bao gồm:
     * - 4: Học sinh đã được đón đi
     * - 7: Học sinh đã được đón về
     *
     * @authenticated
     * Ví dụ xác thực: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID chi tiết chuyến đi cần cập nhật trạng thái check-in. Example:2
     * @bodyParam student_image file required Tệp hình ảnh của học sinh. Hình ảnh phải là tệp jpeg, png, bmp, gif, hoặc svg.
     * @bodyParam current_address string required Địa chỉ hiện tại nơi thực hiện check-in. Example:Sân bay quốc tế Tân Sơn Nhất, Đường Trường Sơn, Tân Bình, Hồ Chí Minh, Việt Nam.
     * @bodyParam current_lat numeric required Vĩ độ của vị trí check-in hiện tại. Example:10.815832
     * @bodyParam current_lng numeric required Kinh độ của vị trí check-in hiện tại. Example:106.664132
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Trạng thái check-in của học sinh đã được cập nhật thành công",
     *      "data": {
     *          "pick_up": "1",
     *          "student": {
     *              "name": "Nguyễn Văn A",
     *              "class": "5A"
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
     *      "message": "Lỗi khi cập nhật trạng thái check-in của học sinh",
     *      "data": []
     * }
     *
     * @param TripDetailRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và các thông tin về chuyến đi và hình ảnh của học sinh.
     * @return JsonResponse
     */
    public function pickupStatus(TripDetailRequest $request): JsonResponse
    {
        try {
            $response = $this->service->checkPickupStatus($request);
            return $this->jsonResponseSuccess(new TripDetailResource($response));
        } catch (Throwable $e) {
            $this->logError('Error uploading destination photo', $e);
            return $this->jsonResponseError('Unable to upload destination photo: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Bỏ qua học sinh trong chuyến đi.
     *
     * API này cho phép đánh dấu một học sinh như đã bỏ qua trong quá trình chuyến đi.
     * Yêu cầu này đòi hỏi phải có ID chi tiết của chuyến đi.
     * Lý do bỏ qua học sinh là tùy chọn nhưng có thể cung cấp để ghi chép chi tiết hơn.
     *
     * @authenticated
     * Ví dụ xác thực: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required ID chi tiết chuyến đi cần bỏ qua học sinh. Example: 14096
     * @bodyParam skip_reason string optional Lý do bỏ qua học sinh. Example: "Lý do sức khỏe"
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Học sinh đã được đánh dấu là bỏ qua thành công",
     *      "data": {
     *          "trip_detail": {
     *              "id": 3,
     *              "status": "skipped",
     *              "skip_reason": "Lý do sức khỏe"
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
     *      "message": "Lỗi khi bỏ qua học sinh",
     *      "data": []
     * }
     *
     * @param TripStudentRequest $request Đối tượng yêu cầu chứa các quy tắc xác thực và thông tin về chuyến đi.
     * @return JsonResponse
     */
    public function skipStudent(TripStudentRequest $request): JsonResponse
    {
        try {
            $response = $this->service->skipStudent($request);
            return $this->jsonResponseSuccess(new TripDetailResource($response));
        } catch (Throwable $e) {
            $this->logError('Error skipping the student', $e);
            return $this->jsonResponseError('Error skipping the student: ' . $e->getMessage(), 500);
        }
    }


}
