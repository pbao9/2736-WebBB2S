<?php

namespace App\Api\V1\Http\Controllers\Parent;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Parent\ParentRequest;
use App\Api\V1\Http\Requests\Parent\TripParentRequest;
use App\Api\V1\Http\Resources\Trip\TripDetailForParentResource;
use App\Api\V1\Http\Resources\Trip\TripNotPaginationResourceCollection;
use App\Api\V1\Repositories\Student\StudentRepositoryInterface;
use App\Api\V1\Services\Parent\ParentServiceInterface;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Http\JsonResponse;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\TripDetail\TripDetailServiceInterface;
use App\Api\V1\Services\User\UserService;
use App\Api\V1\Support\AuthServiceApi;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * @group Phụ huynh
 */
class ParentController extends Controller
{
    use JwtService, Response, UseLog, AuthServiceApi;

    private static string $GUARD_API = 'api';
    private $login;

    protected TripDetailServiceInterface $tripDetailService;

    protected StudentRepositoryInterface $studentRepository;

    protected ParentServiceInterface $parentService;

    public function __construct(
        UserRepositoryInterface    $repository,
        StudentRepositoryInterface $studentRepository,
        TripDetailServiceInterface $tripDetailService,
        UserService                $service,
        ParentServiceInterface     $parentService
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->tripDetailService = $tripDetailService;
        $this->studentRepository = $studentRepository;
        $this->parentService = $parentService;
        $this->middleware('auth:api');
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }


    /**
     * Cập nhật phụ huynh
     *
     * API này dùng để cập nhật thông tin cho phụ huynh
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @bodyParam fullname string
     * Họ và tên của phụ huynh. Example: Phạm Minh Mạnh
     *
     * @bodyParam avatar file
     * Avatar của phụ huynh. Example: avatar.png
     *
     * @bodyParam phone string
     * Số điện thoại của phụ huynh. Example: 0961592551
     *
     * @response 200 {
     *     "status": 200,
     *     "message": "Thực hiện thành công.",
     * }
     *
     * @return JsonResponse
     */
    public function update(ParentRequest $request): JsonResponse
    {
        try {
            $this->service->updateParent($request);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
            ]);
        } catch (Exception $e) {
            $this->logError('Parent update failed: ', $e);
            return $this->jsonResponseError('Parent update failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Lấy danh sách chuyến đi của học sinh theo phụ huynh
     *
     * API này trả về danh sách các chuyến đi liên quan đến học sinh mà phụ huynh đang quản lý.
     * Yêu cầu này đòi hỏi phải có thông tin đăng nhập của phụ huynh và lọc theo ngày nếu cần.
     *
     * @authenticated
     * @queryParam date string Ngày thực hiện chuyến đi để lọc kết quả. Format: YYYY-MM-DD. Example: 2024-08-05
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "trip_id": 1,
     *              "trip_date": "2024-08-01",
     *              "status": "scheduled",
     *              "session": "morning",
     *              "student": {
     *                  "id": 1,
     *                  "fullname": "Nguyễn Văn A",
     *                  "grade": 3
     *              },
     *              "school": {
     *                  "name": "Trường Tiểu học ABC",
     *                  "address": "123 Đường XYZ, TP. HCM"
     *              }
     *          },
     *          {
     *              // Thêm chuyến đi khác
     *          }
     *      ]
     * }
     *
     * @response 403 {
     *     "status": 403,
     *     "message": "Không có quyền truy cập.",
     * }
     *
     * @response 500 {
     *     "status": 500,
     *     "message": "Không thể lấy danh sách chuyến đi do lỗi hệ thống."
     * }
     *
     * @return JsonResponse
     */
    public function getTripsByParent(ParentRequest $request): JsonResponse
    {
        try {
            $response = $this->parentService->getTripsByParent($request);
            return $this->jsonResponseSuccess(new TripNotPaginationResourceCollection($response));
        } catch (Exception $e) {
            $this->logError('Get trips by parent  failed: ', $e);
            return $this->jsonResponseError('Get trips by parent  failed: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Lấy chi tiết chuyến đi của học sinh theo phụ huynh
     *
     * API này trả về thông tin chi tiết về một chuyến đi cụ thể liên quan đến học sinh mà phụ huynh đang quản lý.
     * Yêu cầu này đòi hỏi phải có thông tin đăng nhập của phụ huynh và ID của chuyến đi cần truy xuất.
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
     * @queryParam id int required ID của chuyến đi cần lấy thông tin chi tiết. Example: 14409
     * @queryParam trip_date string required trip date của chuyến đi . Example: 2024-08-05
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 101,
     *          "contract_id": 11,
     *          "code": "TRIP123",
     *          "trip_date": "2024-08-01",
     *          "description": "Chuyến đi buổi sáng.",
     *          "status": "scheduled",
     *          "session": "morning",
     *          "type": "pickup",
     *          "destination_photo": "/public/uploads/trip_photos/photo1.png",
     *          "check_in": "08:00:00",
     *          "check_out": "12:00:00",
     *          "current_address": "123 Đường ABC, TP. HCM",
     *          "current_lat": 10.777889,
     *          "current_lng": 106.699123,
     *          "created_at": "2024-07-01T00:00:00Z",
     *          "updated_at": "2024-07-02T00:00:00Z",
     *          "details": {
     *              "student_id": 1,
     *              "fullname": "Nguyễn Văn A",
     *              "grade": 3
     *          },
     *          "school": {
     *              "name": "Trường Tiểu học ABC",
     *              "address": "123 Đường XYZ, TP. HCM"
     *          },
     *          "driver": {
     *              "name": "Trần Thanh Thảo",
     *              "phone": "0961592552"
     *          },
     *          "nany": {
     *              "name": "Phạm Minh Mạnh",
     *              "phone": "0961592553"
     *          }
     *      }
     * }
     *
     * @response 404 {
     *     "status": 404,
     *     "message": "Không tìm thấy chuyến đi.",
     * }
     *
     * @response 403 {
     *     "status": 403,
     *     "message": "Không có quyền truy cập thông tin này.",
     * }
     *
     * @response 500 {
     *     "status": 500,
     *     "message": "Lỗi hệ thống không thể truy xuất thông tin chuyến đi."
     * }
     *
     * @return JsonResponse
     */
    public function tripDetail(TripParentRequest $request): JsonResponse
    {
        try {
            $response = $this->parentService->tripDetail($request);
            return $this->jsonResponseSuccess(new TripDetailForParentResource($response));
        } catch (Exception $e) {
            $this->logError('Get trip detail by parent  failed: ', $e);
            return $this->jsonResponseError('Get trip detail by parent  failed: ' . $e->getMessage(), 500);
        }
    }



}
