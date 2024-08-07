<?php

namespace App\Api\V1\Http\Controllers\Staff;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Exception\BadRequestException;
use App\Api\V1\Http\Requests\ScheduleOff\StaffScheduleOffRequest;
use App\Api\V1\Http\Resources\ScheduleOff\ScheduleOffResource;
use App\Api\V1\Repositories\ScheduleOff\ScheduleOffRepositoryInterface;
use App\Api\V1\Services\ScheduleOff\ScheduleOffServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Api\V1\Validate\Validator;
use App\Traits\UseLog;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * @group Nhân viên (Tài xế,giám sinh)
 */
class StaffController extends Controller
{
    use AuthServiceApi, Response, UseLog;


    public function __construct(
        ScheduleOffRepositoryInterface $repository,
        ScheduleOffServiceInterface    $service

    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->middleware('auth:api');
    }

    /**
     * Yêu Cầu Ngày Nghỉ Cho Nhân Viên
     *
     * API này cho phép nhân viên (tài xế hoặc giám sinh) yêu cầu ngày nghỉ.
     * Một yêu cầu thành công sẽ đăng ký ngày nghỉ đã chỉ định vào hệ thống.
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     * - 1: Hoạt động
     * - 2: Đã xoá
     *
     * @authenticated
     *
     * @bodyParam date_off string required Ngày yêu cầu nghỉ. Định dạng: Y-m-d. Example: 2024-07-29
     * @bodyParam note string optional Ghi chú giải thích lý do xin nghỉ. Example: Bệnh
     *
     * @response 200 {
     *      "status": "success",
     *      "message": "Yêu cầu ngày nghỉ đã được ghi nhận thành công.",
     *      "data": {
     *          "id": 1,
     *          "date_off": "2024-12-25",
     *          "note": "Gia đình có việc"
     *      }
     * }
     *
     * @response 500 {
     *      "status": "error",
     *      "message": "Yêu cầu ngày nghỉ thất bại. Lỗi: [Chi tiết lỗi]"
     * }
     */
    public function requestDayOff(StaffScheduleOffRequest $request): JsonResponse
    {

        try {
            $response = $this->service->createScheduleOff($request);
            return $this->jsonResponseSuccess(new ScheduleOffResource($response));
        } catch (BadRequestException $e) {
            $this->logError('Bad request when creating schedule off', $e);
            return $this->jsonResponseError($e->getMessage(), 400);
        } catch (Throwable $e) {
            $this->logError('Create schedule off for student', $e);
            return $this->jsonResponseError('Request day off failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Lấy Lịch Làm Việc Cho Nhân Viên
     *
     * API này trả về lịch làm việc của nhân viên, bao gồm cả các ngày đã đăng ký nghỉ.
     * API chỉ trả về lịch làm việc cho nhân viên hiện tại đang đăng nhập.
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     * - 1: Hoạt động
     * - 2: Đã xoá
     *
     * @authenticated
     *
     * @response 200 {
     *      "status": "success",
     *      "message": "Lấy lịch làm việc thành công.",
     *      "data": {
     *          "schedule": ["2", "3", "4", "5", "6", "7"],
     *          "days_off": [
     *              {
     *                  "date_off": "2024-07-20",
     *                  "note": "Nghỉ bệnh"
     *              }
     *          ]
     *      }
     * }
     *
     * @response 404 {
     *      "status": "error",
     *      "message": "Không tìm thấy thông tin nhân viên."
     * }
     */
    public function getSchedule()
    {
        return $this->service->getSchedule();
    }

    /**
     * Xóa Ngày Nghỉ Của Nhân Viên
     *
     * API này dùng để xóa một ngày nghỉ đã được lên lịch cho nhân viên.
     * Chỉ thực hiện thành công nếu ngày nghỉ tồn tại trong cơ sở dữ liệu và
     * có quyền truy cập để xóa.
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     * - 1: Hoạt động
     * - 2: Đã xoá
     *
     * @authenticated
     *
     * @pathParam  id int ID của bản ghi ngày nghỉ cần xóa. Example: 1
     *
     * @response 200 {
     *      "status": "success",
     *      "message": "Scheduled day off has been successfully deleted.",
     *      "data": []
     * }
     *
     * @response 404 {
     *      "status": "error",
     *      "message": "No scheduled day off found with provided ID."
     * }
     *
     * @response 500 {
     *      "status": "error",
     *      "message": "Failed to delete the scheduled day off due to an internal error."
     * }
     *
     * @return JsonResponse Returns a JSON response indicating the success or failure of the operation.
     */
    public function delete($id): JsonResponse
    {
        try {
            if (Validator::validateExists($this->repository, $id)) {
                $response = $this->service->delete($id);
                return $this->jsonResponseSuccess(new ScheduleOffResource($response));
            } else {
                return $this->jsonResponseError("No student found with ID: $id", 404);
            }

        } catch (Throwable $e) {
            $this->logError('Delete schedule off', $e);
            return $this->jsonResponseError("Delete schedule off failed: " . $e->getMessage(), 500);
        }
    }

    /**
     * Khôi Phục Ngày Nghỉ Của Nhân Viên (chuyển trạng thái thành hoạt động)
     *
     * API này dùng để khôi phục một ngày nghỉ đã bị xóa cho nhân viên.
     * Chỉ thực hiện thành công nếu ngày nghỉ tồn tại trong cơ sở dữ liệu và
     * có quyền truy cập để khôi phục.
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     * - 1: Hoạt động
     * - 2: Đã xoá
     *
     * @authenticated
     *
     * @pathParam id int ID của bản ghi ngày nghỉ cần khôi phục. Example: 1
     *
     * @response 200 {
     *      "status": "success",
     *      "message": "Ngày nghỉ đã được khôi phục thành công.",
     *      "data": {
     *          "id": 1,
     *          "date_off": "2024-12-25",
     *          "note": "Gia đình có việc"
     *      }
     * }
     *
     * @response 404 {
     *      "status": "error",
     *      "message": "Không tìm thấy ngày nghỉ đã xóa với ID cung cấp."
     * }
     *
     * @response 500 {
     *      "status": "error",
     *      "message": "Khôi phục ngày nghỉ thất bại do lỗi hệ thống."
     * }
     *
     * @return JsonResponse Returns a JSON response indicating the success or failure of the operation.
     */
    public function restore($id): JsonResponse
    {
        try {
            if (Validator::validateExists($this->repository, $id)) {
                $response = $this->service->restore($id);
                return $this->jsonResponseSuccess(new ScheduleOffResource($response));
            } else {
                return $this->jsonResponseError("No day off found with ID: $id", 404);
            }

        } catch (Throwable $e) {
            $this->logError('Restore schedule off', $e);
            return $this->jsonResponseError("Restore schedule off failed: " . $e->getMessage(), 500);
        }
    }


}
