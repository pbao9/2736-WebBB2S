<?php

namespace App\Api\V1\Http\Controllers\Contract;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Resources\Contract\ContractResource;
use App\Api\V1\Repositories\Contract\ContractRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepository;
use App\Api\V1\Support\AuthServiceApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @group Hợp đồng
 */
class ContractController extends Controller
{
    use AuthServiceApi;

    private static string $GUARD_API = 'api';
    private $login;
    protected $userRepository;

    public function __construct(
        ContractRepositoryInterface $repository,
        UserRepository $userRepository,
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }

    /**
     * Lấy danh sách hợp đồng của phụ huynh.
     *
     * Trạng thái của hợp đồng (status) bao gồm: 
     * - 1: Đang hoạt động
     * - 2: Đã kết thúc hợp đồng
     * - 3: Bản nháp
     * - 4: Sẵn sàng
     * 
     * Lịch học theo hợp đồng (schedule[]):
     * - 1: Chủ nhật
     * - 2: Thứ hai
     * - 3: Thứ ba
     * - 4: Thứ tư
     * - 5: Thứ năm
     * - 6: Thứ sáu
     * - 7: Thứ bảy
     * 
     * Buổi đưa học sinh tới trường (session_arrive_school):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     * 
     * Buổi đón học sinh từ trường về nhà (session_off):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     * 
     * Loại hợp đồng (type) bao gồm:
     * - 1: Cả đưa và đón
     * - 2: Chỉ đón đi
     * - 3: Chỉ đón về
     * 
     * Giải thích thêm một số biến:
     * - time_off: Thời gian đón học sinh từ trường về nhà
     * - time_arrive_school: Thời gian học sinh tới trường
     * 
     * API này trả về danh sách hợp đồng của phụ huynh 
     * @authenticated
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 2,
     *              "expired_at": "2025-07-11 15:26:45",
     *              "nany_id": 1,
     *              "schedule": "[\"1\",\"2\",\"3\",\"4\"]",
     *              "type": 1,
     *              "status": 4,
     *              "school_id": 1,
     *              "driver_id": 1,
     *              "created_at": "2024-07-11T08:26:45.000000Z",
     *              "updated_at": "2024-07-11T09:14:52.000000Z",
     *              "session_arrive_school": 1,
     *              "session_off": 2,
     *              "time_off": "17:05:24",
     *              "time_arrive_school": "17:06:02"
     *          }
     *      ]
     * }
     *
     * @return JsonResponse
     */
    public function view(): JsonResponse
    {
        $parentId = $this->getCurrentParentId();
        $data = $this->repository->getAllContractParent($parentId);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $data
        ]);
    }

    /**
     * Lấy thông tin chi tiết một hợp đồng (Phụ huynh).
     * 
     * Trạng thái của hợp đồng (status) bao gồm: 
     * - 1: Đang hoạt động
     * - 2: Đã kết thúc hợp đồng
     * - 3: Bản nháp
     * - 4: Sẵn sàng
     * 
     * Lịch học theo hợp đồng (schedule[]):
     * - 1: Chủ nhật
     * - 2: Thứ hai
     * - 3: Thứ ba
     * - 4: Thứ tư
     * - 5: Thứ năm
     * - 6: Thứ sáu
     * - 7: Thứ bảy
     * 
     * Buổi đưa học sinh tới trường (session_arrive_school):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     * 
     * Buổi đón học sinh từ trường về nhà (session_off):
     * - 1: Buổi sáng
     * - 2: Buổi chiều
     * 
     * Tuỳ chọn thông báo (notification_preference): 
     * - 1: Cho phép nhận thông báo
     * - 2: Tắt nhận thông báo
     * 
     * Loại hợp đồng (type) bao gồm:
     * - 1: Cả đưa và đón
     * - 2: Chỉ đón đi
     * - 3: Chỉ đón về
     * 
     * Giới tính (gender): 
     * - 1: Nam
     * - 2: Nữ
     * - 3: Khác
     * 
     * Giải thích thêm một số biến:
     * - time_off: Thời gian đón học sinh từ trường về nhà
     * - time_arrive_school: Thời gian học sinh tới trường
     * - time_pick: Thời gian đón học sinh từ nhà đến trường
     * - time_arrive_home: Thời gian học sinh tới nhà
     * - totalStudent: Tổng số học sinh của hợp đồng đó
     *
     * API này trả về thông tin chi tiết của một hợp đồng
     * @authenticated
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "nany_id": 1,
     *          "school_id": 2,
     *          "driver_id": 1,
     *          "totalStudent": 1,
     *          "status": 4,
     *          "type": 1,
     *          "created_at": "2024-07-11T08:18:05.000000Z",
     *          "expired_at": "2025-07-11 15:18:05",
     *          "schedule": "[\"1\",\"2\",\"3\",\"4\",\"5\"]",
     *          "session_arrive_school": 1,
     *          "session_off": 2,
     *          "time_arrive_school": "17:05:59",
     *          "time_off": "17:05:20",
     *          "detail": [
     *              {
     *                  "id": 1,
     *                  "pick_address": "Thành phố Hồ Chí Minh, Hồ Chí Minh, Việt Nam",
     *                  "latitude": 10.840203,
     *                  "longitude": 106.648118,
     *                  "parent_id": 1,
     *                  "student_id": 1,
     *                  "contract_id": 1,
     *                  "created_at": "2024-07-11T08:18:05.000000Z",
     *                  "updated_at": "2024-07-11T08:18:05.000000Z",
     *                  "time_pick": "07:00:00",
     *                  "time_arrive_home": "17:06:34"
     *              },
     *             ],
     *          "school": {
     *              "id": 2,
     *              "name": "Cheung Ka Ming",
     *              "latitude": 906.764726,
     *              "longitude": 959.733158,
     *              "address": "123 Gò Vấp",
     *              "created_at": "2001-03-18T19:15:50.000000Z",
     *              "updated_at": "2004-08-06T08:31:04.000000Z"
     *           },
     *          "nany": {
     *              "id": 4,
     *              "area_id": null,
     *              "username": "0961592554",
     *              "slug": "pham-minh-manhhhhhhhh-1",
     *              "fullname": "Phạm Minh MạnhHHHHHHH",
     *              "email": "admin@gmail.com",
     *              "phone": "0987606322",
     *              "avatar": "public/uploads/images/nannies//poWh8E686sTZ0GTU5Nzcci2ignLcy3lGi4O1BZOM.jpg",
     *              "birthday": "2001-11-11",
     *              "device_token": null,
     *              "gender": 1,
     *              "email_verified_at": null,
     *              "token_get_password": null,
     *              "active": true,
     *              "status": 1,
     *              "notification_preference": 1,
     *              "address": "DongNai",
     *              "latitude": 10.840155,
     *              "longitude": 106.648005,
     *              "created_at": "2024-07-11T07:54:21.000000Z",
     *              "updated_at": "2024-07-15T09:39:35.000000Z"
     *           },
     *           "driver": {
     *              "id": 5,
     *              "area_id": null,
     *              "username": "0961592555",
     *              "slug": "pham-minh-manhhhhhhhh",
     *              "fullname": "Phạm Minh MạnhHHHHHHH",
     *              "email": "phammanhbeo2001@gmail.com"
     *              "phone": "0987666123"
     *              "avatar": "public/uploads/images/drivers//Pet7XKyUNOeX1ZO2vbWY46AOcl0cx2bEEkz2duOD.jpg"
     *              "birthday": "2001-11-11"
     *              "device_token": null
     *              "gender": 1
     *              "email_verified_at": null
     *              "token_get_password": null
     *              "active": true
     *              "status": 1
     *              "notification_preference": 1
     *              "address": "Thành phố Hồ Chí Minh, Hồ Chí Minh, Việt Nam"
     *              "latitude": 10.840173
     *              "longitude": 106.648076
     *              "created_at": "2024-07-11T07:54:57.000000Z"
     *              "updated_at": "2024-07-15T09:38:25.000000Z"
     *           },
     *      }
     * }
     *
     * @return JsonResponse
     */
    public function getDetail($id): JsonResponse
    {
        $parentId = $this->getCurrentParentId();
        if(!$parentId){
            return response()->json([
               'status' => 403,
               'message' => __('unAuthorized'),
            ], 403);
        }
        $data = $this->repository->findWithDetail($id, $parentId);
        $data['total'] = $data->detail->count();
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new ContractResource($data)
        ]);
    }
}
