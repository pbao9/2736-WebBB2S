<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Auth\UpdatePasswordRequest;
use App\Api\V1\Repositories\User\UserRepository;
use App\Api\V1\Support\AuthServiceApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @group Người dùng
 */
class ChangePasswordController extends Controller
{
    use AuthServiceApi;

    private static string $GUARD_API = 'api';
    private $login;
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api');
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }

    /**
     * Đổi mật khẩu.
     * 
     * API này dùng để đổi mật khẩu cho người dùng
     * @authenticated
     * 
     * @bodyParam new_password string required
     * Mật khẩu mới. Example: 123456
     * 
     * @bodyParam new_password_confirmation string required
     * Lặp lại mật khẩu mới. Example: 123456
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     * }
     * 
     * @response 500 {
     *      "status": 500,
     *      "message": "Error updating password: ...",
     * }
     *
     * @return JsonResponse
     */
    public function changePassword(UpdatePasswordRequest $request): JsonResponse
    {
        try {
            $data['password'] = bcrypt($request->input('new_password'));
            $userId = $this->getCurrentUserId();
            $this->userRepository->update($userId, $data);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'error' => 'Error updating password:' . $th->getMessage(),
            ], 500);
        }
    }
}
