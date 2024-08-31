<?php

namespace App\Api\V1\Http\Controllers\Nany;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Nany\NanyRepositoryInterface;
use App\Api\V1\Http\Requests\Nany\NanyRequest;
use App\Api\V1\Support\Response;
use App\Traits\JwtService;
use App\Traits\UseLog;
use Illuminate\Http\JsonResponse;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\User\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;

/**
 * @group Giám sinh
 */
class NanyController extends Controller
{
    use JwtService, Response, UseLog;

    private static string $GUARD_API = 'api';
    private $login;

    protected $nanyRepository;

    public function __construct(
        UserRepositoryInterface $repository,
        NanyRepositoryInterface $nanyRepository,
        UserService $service,
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->nanyRepository = $nanyRepository;
        $this->middleware('auth:api');
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }

    /**
     * Cập nhật Giám sinh
     *
     * API này dùng để cập nhật thông tin cho Giám sinh
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @bodyParam fullname string 
     * Họ và tên của Giám sinh. Example: Phạm Minh Mạnh
     * 
     * @bodyParam avatar file 
     * Avatar. Example: avatar.png
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
     * }
     *
     * @return JsonResponse
     */
    public function update(NanyRequest $request): JsonResponse
    {
        try {
            $this->service->updateNany($request);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
            ]);
        } catch (Exception $e) {
            $this->logError('Nany update failed: ' , $e);
            return $this->jsonResponseError($e->getMessage(), 500);
        }
    }
}
