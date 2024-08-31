<?php

namespace App\Api\V1\Http\Controllers\Student;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Parent\ParentRepositoryInterface;
use App\Api\V1\Exception\NotFoundException;
use App\Api\V1\Http\Requests\ScheduleOff\ScheduleOffRequest;
use App\Api\V1\Http\Requests\Student\StudentRequest;
use App\Api\V1\Http\Resources\Student\StudentResource;
use App\Api\V1\Http\Resources\Student\StudentResourceCollection;
use App\Api\V1\Repositories\ScheduleOff\ScheduleOffRepositoryInterface;
use App\Api\V1\Repositories\Student\StudentRepositoryInterface;
use App\Api\V1\Services\Student\StudentServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Api\V1\Validate\Validator;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Học sinh
 */
class StudentController extends Controller
{
    use AuthServiceApi, Response, UseLog;


    protected ParentRepositoryInterface $parentRepository;

    protected ScheduleOffRepositoryInterface $scheduleOffRepository;

    public function __construct(
        StudentRepositoryInterface     $repository,
        ParentRepositoryInterface      $parentRepository,
        StudentServiceInterface        $service,
        ScheduleOffRepositoryInterface $scheduleOffRepository,

    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->parentRepository = $parentRepository;
        $this->scheduleOffRepository = $scheduleOffRepository;
        $this->middleware('auth:api');
    }


    /**
     * Lấy thông tin học sinh
     *
     * API này trả về thông tin chi tiết của một học sinh
     *
     * Lịch học (schedule[]):
     * - 1: Chủ nhật
     * - 2: Thứ hai
     * - 3: Thứ ba
     * - 4: Thứ tư
     * - 5: Thứ năm
     * - 6: Thứ sáu
     * - 7: Thứ bảy
     *
     * Lớp của học sinh (grade):
     * - 1: Lớp 1
     * - 2: Lớp 2
     * - 3: Lớp 3
     * - 4: Lớp 4
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @pathParam id integer required ID của học sinh. Phải tồn tại trong bảng `students`. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "fullname": "Phạm Minh Mạnh D19CQCN03-N",
     *          "email": "admin@gmail.com",
     *          "phone": "0872111421",
     *          "address": "Thành phố Hồ Chí Minh, Hồ Chí Minh, Việt Nam",
     *          "gender": 1,
     *          "active": true,
     *          "longitude": 106.647908,
     *          "latitude": 10.840123,
     *          "area_id": null,
     *          "notification_preference": 1,
     *          "status": 1,
     *          "created_at": "2024-06-25T07:36:32.000000Z"
     *      }
     * }
     *
     * @response 404 {
     *      "status": 404,
     *      "message": "Not found"
     * }
     *
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function show($id): JsonResponse
    {
        $student = $this->repository->find($id);
        if (!$student) {
            return response()->json([
                'status' => 404,
                'message' => __('NotFound')
            ], 404);
        }
        $parentId = $this->getCurrentParentId();
        $result = $this->repository->isChildOfParent($student->id, $parentId);
        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => new StudentResource($student)
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => __('unAuthorized'),
            ], 403);
        }
    }

    /**
     * Lấy danh sách học sinh của phụ huynh
     *
     * API này trả về danh sách học sinh của phụ huynh đang đăng nhập
     * 
     * Lịch học (schedule[]):
     * - 1: Chủ nhật
     * - 2: Thứ hai
     * - 3: Thứ ba
     * - 4: Thứ tư
     * - 5: Thứ năm
     * - 6: Thứ sáu
     * - 7: Thứ bảy
     * 
     * Lớp của học sinh (grade): 
     * - 1: Lớp 1
     * - 2: Lớp 2
     * - 3: Lớp 3
     * - 4: Lớp 4
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 1,
     *              "fullname": "Phạm Minh Mạnh D19CQCN03-N",
     *              "avatar": "/public/assets/images/default-image.png",
     *              "schedule": "[\"0\",\"3\",\"5\",\"6\"]",
     *              "phone": null,
     *              "name_other": null,
     *              "phone_other": null,
     *              "note": null,
     *              "grade": 1,
     *              "created_at": "2024-06-28T08:16:19.000000Z"
     *          }
     *      ]
     * }
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function view(): JsonResponse
    {
        $parentId = $this->getCurrentParentId();
        $students = $this->parentRepository->findOrFail($parentId)->students;
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new StudentResourceCollection($students)
        ]);
    }
    /**
     * Cập nhật học sinh
     *
     * API này dùng để cập nhật học sinh dành cho phụ huynh
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @bodyParam id int required id của học sinh.
     * @bodyParam fullname string Họ và tên của học sinh.
     * @bodyParam avatar url Avatar của học sinh.
     * @bodyParam name_other string Tên khác.
     * @bodyParam phone_other string Số điện thoại khác.
     * @bodyParam note string Ghi chú.
     * @bodyParam grade int Lớp học của học sinh (1 - 4).
     * @bodyParam grade_detail string Họ và tên của học sinh.
     * 
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 14,
     *              "fullname": "Nguyễn Trần",
     *              "avatar": null,
     *              "schedule": "[0,1,2,3,4,5,6]",
     *              "phone": "0961592553",
     *              "name_other": null,
     *              "phone_other": null,
     *              "note": null,
     *              "grade": 1,
     *              "created_at": "2024-06-28T09:46:08.000000Z"
     *          }
     *      ]
     * }
     *
     * @return JsonResponse
     */
    public function update(StudentRequest $request): JsonResponse
    {
        $result = $this->service->update($request);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $result
        ]);
    }

    /**
     * Lấy lịch học và ngày nghỉ của học sinh
     *
     * API này dùng để lấy thông tin lịch học và các ngày nghỉ đã đăng ký của một học sinh cụ thể. Yêu cầu này đòi hỏi phải có ID của học sinh.
     *
     * Các thể loại  (type) của ngày nghỉ bao gồm:
     *  - 1: Public (ngày nghỉ chung)
     *  - 2: Private (ngày nghỉ riêng)
     *  - 3:Normal (Chưa phân loại)
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     *  - 1: Hoạt động
     *  - 2: Đã xoá
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @pathParam id integer required ID của học sinh. Phải tồn tại trong bảng `students`. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Lấy lịch học và ngày nghỉ thành công.",
     *      "data": {
     *          "schedule": [
     *              // Mảng các lịch học
     *          ],
     *          "days_off": [
     *              {
     *                  "date_off": "2024-07-20T17:00:00.000000Z",
     *                  "note": "Nghỉ"
     *              }
     *              // Thêm các ngày nghỉ khác
     *          ]
     *      }
     * }
     *
     * @response 404 {
     *      "status": 404,
     *      "message": "Không tìm thấy học sinh với ID cung cấp."
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Lỗi khi lấy thông tin lịch học và ngày nghỉ."
     * }
     *
     * @param int $id Đối tượng yêu cầu chứa ID của học sinh.
     * @return JsonResponse
     */
    public function getSchedule(int $id): JsonResponse
    {
        try {
            if (Validator::validateExists($this->repository, $id)) {
                $response = $this->service->getScheduleForStudent($id);
                return $this->jsonResponseSuccess($response);
            } else {
                return $this->jsonResponseError("No student found with ID: $id", 404);
            }
        } catch (NotFoundException $e) {
            $this->logError('Error finding student with ID: ' . $id, $e);
            return $this->jsonResponseError("No student found with ID: $id", 404);
        } catch (Exception $e) {
            $this->logError('Error updating status', $e);
            return $this->jsonResponseError("Get schedule for student failed: " . $e->getMessage(), 500);
        }
    }

    /**
     * Yêu cầu ngày nghỉ cho học sinh.
     *
     * API này cho phép yêu cầu ngày nghỉ cho một học sinh bằng cách gửi ID của học sinh,
     * ngày nghỉ, và ghi chú tùy chọn giải thích lý do vắng mặt.
     * Hành động này yêu cầu ID học sinh phải tồn tại trong cơ sở dữ liệu.
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     *  - 1: Hoạt động
     *  - 2: Đã xoá
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @bodyParam student_id int required ID của học sinh. Phải tồn tại trong bảng `students`.
     * @bodyParam date_off string required Ngày nghỉ được yêu cầu. Định dạng YYYY-MM-DD. Example: 2024-07-17
     * @bodyParam note string Ghi chú lý do xin nghỉ (tùy chọn). Example: Bệnh
     *
     * @response 200 {
     *      "status": "success",
     *      "message": "Yêu cầu ngày nghỉ đã được ghi nhận thành công.",
     *      "data": {
     *          "student_id": 1,
     *          "date_off": "2024-07-15",
     *          "note": "Gia đình có sự kiện"
     *      }
     * }
     *
     * @response 400 {
     *      "status": "error",
     *      "message": "Thông tin gửi lên không hợp lệ. Vui lòng kiểm tra lại các trường dữ liệu."
     * }
     *
     * @response 404 {
     *      "status": "error",
     *      "message": "Không tìm thấy học sinh với ID cung cấp."
     * }
     *
     * @response 500 {
     *      "status": "error",
     *      "message": "Có lỗi xảy ra trong quá trình xử lý yêu cầu."
     * }
     *
     * @return JsonResponse
     */
    public function requestDayOff(ScheduleOffRequest $request): JsonResponse
    {

        try {
            $response = $this->service->createScheduleOff($request);
            return $this->jsonResponseSuccess($response);
        } catch (Exception $e) {
            $this->logError('Create schedule off for student', $e);
            return $this->jsonResponseError('Request day off failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Xóa một ngày nghỉ đã lên lịch của học sinh.
     *
     * API này dùng để xóa một ngày nghỉ đã được lên lịch cho học sinh dựa trên ID của bản ghi ngày nghỉ.
     * Phương thức này kiểm tra xem bản ghi có tồn tại không trước khi thực hiện xóa. Nếu không tìm thấy bản ghi,
     * nó sẽ trả về một lỗi. Nếu xóa thành công, một phản hồi thành công sẽ được trả lại.
     *
     * Các trạng thái (status) của ngày nghỉ bao gồm:
     *  - 1: Hoạt động
     *  - 2: Đã xoá
     *
     * @queryParam id integer  ID của bản ghi ngày nghỉ cần xóa.
     * @queryParam student_id integer  ID học sinh.
     *
     * @return JsonResponse Trả về JsonResponse để thông báo kết quả của việc xóa.
     *
     * @authenticated
     *
     * @response 200 {
     *      "status": "success",
     *      "message": "Scheduled day off has been successfully deleted."
     * }
     *
     * @response 404 {
     *      "status": "error",
     *      "message": "Scheduled day off not found."
     * }
     *
     * @response 500 {
     *      "status": "error",
     *      "message": "Error deleting schedule. Please try again later."
     * }
     */
    public function delete(ScheduleOffRequest $request): JsonResponse
    {
        try {
            $this->service->delete($request);
            return $this->jsonResponseSuccess(self::$EMPTY_ARRAY);
        } catch (Exception $e) {
            $this->logError('Delete schedule off', $e);
            return $this->jsonResponseError("Delete schedule off failed: " . $e->getMessage(), 500);
        }
    }
}
