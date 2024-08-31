<?php

namespace App\Api\V1\Http\Controllers\Notification;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Services\Notification\NotificationServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Người dùng
 */
class UpdateDeviceTokenController extends Controller
{
    use AuthServiceApi;

    private static string $GUARD_API = 'api';
    private $login;

    public function __construct(
        NotificationServiceInterface $service,
    ) {
        $this->service = $service;
        $this->middleware('auth:api');
    }

    protected function resolve(): bool
    {
        return Auth::attempt($this->login);
    }

    /**
     * Cập nhật device_token.
     * 
     * API này dùng để cập nhật device_token cho người dùng
     * @authenticated
     * 
     * @bodyParam device_token string required
     * Device Token. Example: fKyIN9ACdV873pS0aOUrSi:APA91bHED_QSz3XnUSMQst7jtTQPLZEwkEn-CbTLnYWCxuwg-2xx2xEZO1fpltclMG0zVxKdkOMMzlx0taaxGu6HiWfYLVFJkVWeaMQRAnGsL65-O5OTbIIfs1j3ntpNakLQhc4KtVSB
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     * }
     * 
     * @response 500 {
     *      "status": 500,
     *      "message": "Error updating device token: ...",
     * }
     *
     * @return JsonResponse
     */
    public function updateDeviceToken(Request $request): JsonResponse
    {
        try {
            $this->service->updateDeviceToken($request);
            return response()->json([
                'status' => 200,
                'message' => 'Thực hiện thành công.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'error' => 'Error updating device token: ' . $th->getMessage(),
            ], 500);
        }
    }
}
