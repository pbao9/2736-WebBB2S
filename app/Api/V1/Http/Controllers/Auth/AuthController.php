<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Auth\LoginRequest;
use App\Api\V1\Http\Requests\Auth\RefreshTokenRequest;
use App\Api\V1\Http\Resources\Driver\DriverResource;
use App\Api\V1\Http\Resources\Nany\NanyResource;
use App\Api\V1\Http\Resources\Parent\ParentResource;
use App\Api\V1\Repositories\User\UserRepository;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @group Người dùng
 */
class AuthController extends Controller
{
    use AuthServiceApi, UseLog, Response, JwtService;

    private static string $GUARD_API = 'api';
    private $login;
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }
    /**
     * Login
     *
     * API này dùng để đăng nhập
     * 
     * Trạng thái của nhân viên (staff_status): 
     * - 1: Đang hoạt động
     * - 2: Tạm nghỉ
     *
     * @bodyParam phone string
     * Số điện thoại. Example: 0961592551
     * 
     * @bodyParam password string 
     * Mật khẩu. Example: 123456
     * 
     * @response 200 {
     *      "status": 200,
     *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzIyMjI5MDAxLCJleHAiOjE3Mjc0MTMwMDEsIm5iZiI6MTcyMjIyOTAwMSwianRpIjoiUUFQV0ZKRDV5Wmc5b0QyRyIsInN1YiI6IjEyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.webD9xxJosASetj6YwPHZz488Qwl27D9W6-Ki0_xYqs",
     *      "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxMiwicmFuZG9tIjoiNDIzMTk4MzU2MTcyMjIyOTAwMSIsImlzX3JlZnJlc2hfdG9rZW4iOnRydWUsImV4cCI6MTcyMjc1NDYwMX0.301n_y_JeoAQGWT7vKta-804qopieN9RprC7jJST6Mo",
     *      "role": "parents",
     *      "staff_status": null,
     *      "expires_in": 5184000
     * }
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return $this->loginUser($request);
        } catch (Exception $e) {
            $this->logError("Login failed", $e);
            return $this->jsonResponseError("Login failed: " . $e->getMessage());
        }
    }

    /**
     * Refresh Token
     *
     * API này dùng để refresh token
     * 
     * @response 200 {
     *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9uYW5uaWVzL2xvZ2luIiwiaWF0IjoxNzIwNjAzMTg3LCJleHAiOjE3MjU3ODcxODcsIm5iZiI6MTcyMDYwMzE4NywianRpIjoiOGIya3NnT0tXck52ZHdzOSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.puwIDR3EmvLD4w37Qxo0EpJbKgFFsYYhbHLHd_s6t9c",
     *      "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxLCJyYW5kb20iOiIzMzM4MzQzNDUxNzIwNjAzMTg3IiwiaXNfcmVmcmVzaF90b2tlbiI6dHJ1ZSwiZXhwIjoxNzIxMTI4Nzg3fQ.S_i_Yu855CmjerD7d3ib2Tjw6m5dE3INLCUOnsoLA7Y",
     *      "expires_in": 5184000
     * }
     * 
     * @response 401 {
     *      "message": "Invalid token.",
     *      "error": "JWT payload does not contain the required claims"
     * }
     *
     * @return JsonResponse
     */
    public function refresh(RefreshTokenRequest $request): JsonResponse
    {
        try {
            return $this->refreshToken($request);
        } catch (Exception $e) {
            $this->logError("Token refresh failed", $e);
            return $this->jsonResponseError("Refresh token failed: " . $e->getMessage());
        }
    }


    /**
     * Đăng xuất
     *
     * API này dùng để đăng xuất
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     * 
     * @response 200 {
     *     "message": "Successfully logged out"
     * }
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            return $this->logoutUser();
        } catch (Exception $e) {
            $this->logError("Logout failed", $e);
            return $this->jsonResponseError("Logout failed: " . $e->getMessage());
        }
    }

    /**
     * Lấy thông tin người dùng
     * 
     * Tuỳ chọn thông báo (notification_preference): 
     * - 1: Cho phép nhận thông báo
     * - 2: Tắt nhận thông báo
     * 
     * Trạng thái tài xế (order_accepted): 
     * - 1: Đang hoạt động
     * - 2: Tạm nghỉ
     * 
     * Giới tính (gender): 
     * - 1: Nam
     * - 2: Nữ
     * - 3: Khác
     *
     * API này trả về thông tin chi tiết của người dùng
     * @authenticated
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 1,
     *          "user": {
     *              "id": 3,
     *              "fullname": "Trần Ngọc Thuỷ Trúc",
     *              "email": "thuytruc@gmail.com",
     *              "phone": "0383476968",
     *              "address": "Nhà Thờ Giáo Xứ Hòa Phát, Nguyễn Đình Chiểu, Lộc Phát, Bảo Lộc, Lâm Đồng, Việt Nam",
     *              "gender": 1,
     *              "active": true,
     *              "longitude": 107.834113,
     *              "latitude": 11.557543,
     *              "area_id": null,
     *              "notification_preference": 1,
     *              "status": 1,
     *              "created_at": "2024-07-10T07:33:18.000000Z",
     *              "roles": [
     *                  "nany"
     *              ]
     *          },
     *          "current_address": "Nhà Thờ Giáo Xứ Hòa Phát, Nguyễn Đình Chiểu, Lộc Phát, Bảo Lộc, Lâm Đồng, Việt Nam",
     *          "current_lat": 11.557543,
     *          "current_lng": 107.834113,
     *          "id_card": "012345678942",
     *          "id_card_date": "2021-01-01",
     *          "id_card_front": "public/uploads/images/nannies//IXPJxrgpwJB7xGlunRiRDyReIrgFYJHBsaUURcPy.png",
     *          "id_card_back": "public/uploads/images/nannies//b922lGTZWh3C12SaKNIz9myXBpefYfcH0eXwoexS.jpg"
     *      }
     * }
     * 
     * @response 403 {
     *      "message": "You do not have permission to access.",
     *      "error": "Forbidden."
     * }
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        try {
            $user = $this->getCurrentUser();
            $nany = $this->getCurrentNany();
            $driver = $this->getCurrentDriver();
            if ($user->parent) {
                return response()->json([
                    'status' => 200,
                    'message' => __('notifySuccess'),
                    'data' => new ParentResource($user)
                ]);
            }
            if ($nany) {
                return response()->json([
                    'status' => 200,
                    'message' => __('notifySuccess'),
                    'data' => new NanyResource(['user' => $user, 'nany' => $nany])
                ]);
            }
            if ($driver) {
                return response()->json([
                    'status' => 200,
                    'message' => __('notifySuccess'),
                    'data' => new DriverResource(['user' => $user, 'driver' => $driver])
                ]);
            }
            return response()->json(['error' => 'Forbidden.', 'message' => 'You do not have permission to access.'], 403);
        } catch (Exception $e) {
            $this->logError("Fetch user information failed", $e);
            return $this->jsonResponseError("Fetch user information failed: " . $e->getMessage());
        }
    }
}
