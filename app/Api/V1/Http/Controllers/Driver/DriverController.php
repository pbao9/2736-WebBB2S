<?php

namespace App\Api\V1\Http\Controllers\Driver;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Driver\DriverRequest;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Http\JsonResponse;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * @group Tài xế
 */
class DriverController extends Controller
{
    use JwtService, UseLog, Response, AuthServiceApi;

    private static string $GUARD_API = 'api';
    private $login;

    public function __construct(
        UserRepositoryInterface $repository,
        UserService $service,
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->middleware('auth:api');
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }

    /**
     * Cập nhật Tài xế
     *
     * API này dùng để cập nhật thông tin cho Tài xế
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @bodyParam fullname string 
     * Họ và tên của Tài xế. Example: Phạm Minh Mạnh
     * 
     * @bodyParam avatar file 
     * Avatar. Example: avatar.png
     * 
     * @bodyParam license_plate string 
     * Biển số xe. Example: 123ABC
     * 
     * @bodyParam id_card string 
     * Số căn cước công dân. Example: 012345678912
     * 
     * @bodyParam id_card_date date 
     * Ngày cấp căn cước công dân. Example: 15-09-2020
     * 
     * @bodyParam id_card_front file 
     * Mặt trước căn cước công dân. Example: front.png
     * 
     * @bodyParam id_card_back file 
     * Mặt sau căn cước công dân. Example: back.png
     * 
     * @bodyParam phone string 
     * Số điện thoại. Example: 0961592551
     * 
     * @response 200 {
     *     "status": 200,
     *     "message": "Thực hiện thành công.",
     *     "data": []
     * }
     *
     * @return JsonResponse
     */
    public function update(DriverRequest $request): JsonResponse
    {
        try {
            $response = $this->service->updateDriver($request);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => []
            ]);
        } catch (Exception $e) {
            $this->logError('Driver update failed: ' , $e);
            return $this->jsonResponseError("Driver update failed: " . $e->getMessage(), 500);
        }
    }
}
