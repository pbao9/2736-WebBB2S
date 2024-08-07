<?php

namespace App\Admin\Services\Notification;

use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Repositories\Nany\NanyRepositoryInterface;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\Parent\ParentRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Enums\Notification\NotificationStatus;
use App\Traits\AuthService;
use App\Traits\NotifiesViaFirebase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationService implements NotificationServiceInterface
{
    use NotifiesViaFirebase, AuthService;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    private AdminRepositoryInterface $adminRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        NotificationRepositoryInterface $repository,
        UserRepositoryInterface        $userRepository,
        AdminRepositoryInterface        $adminRepository,
    ) {
        $this->repository = $repository;
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Lưu trữ thông báo và gửi đến những người nhận phù hợp.
     *
     * @param Request $request  Yêu cầu chứa dữ liệu thông báo đã được kiểm duyệt.
     * @return bool True nếu thông báo được lưu trữ và gửi thành công, False nếu không.
     */
    public function store(Request $request)
    {
        $this->data = $request->validated();

        $notification = false;

        switch ($this->data['type']) {
            case \App\Enums\Notification\NotificationType::All:
                $recipients = $this->adminRepository;
                foreach ($recipients as $repository) {
                    $users = $repository->getAll();
                    foreach ($users as $user) {
                        $this->data['parent_id'] = null;
                        $this->data['driver_id'] = null;
                        $this->data['nany_id'] = null;
                        $this->data['admin_id'] = $user->id;

                        $notification = $this->repository->create($this->data);

                        $device_token = $user->device_token;
                        $this->data['device_token'] = $device_token;

                        if ($notification && $device_token) {
                            $this->sendFirebaseNotification([$device_token], null, $notification->title, $notification->message);
                        }
                    }
                }
                break;
            case \App\Enums\Notification\NotificationType::Driver:
                $this->data['parent_id'] = null;
                $this->data['nany_id'] = null;
                $notification = $this->handleNotificationOption('driver_id');
                break;
            case \App\Enums\Notification\NotificationType::Nany:
                $this->data['parent_id'] = null;
                $this->data['driver_id'] = null;
                $notification = $this->handleNotificationOption('nany_id');
                break;
            default:
                $this->data['driver_id'] = null;
                $this->data['nany_id'] = null;
                $notification = $this->handleNotificationOption('parent_id'); // Xử lý mặc định hoặc kiểu không xác định
                break;
        }

        return $notification ? true : false; // Trả về trạng thái thành công dựa trên việc tạo thông báo
    }

    /**
     * Xử lý tùy chọn gửi thông báo dựa trên kiểu người nhận và dữ liệu yêu cầu.
     *
     * @param string $objectId Tên trường lưu trữ ID người dùng trong kho lưu trữ.
     * @return bool True nếu thông báo được tạo và gửi thành công, False nếu không.
     */
    private function handleNotificationOption(string $objectId)
    {
        // if ($this->data['option'] == \App\Enums\Notification\NotificationOption::All) {
        //     switch ($this->data['type']) {
        //         case \App\Enums\Notification\NotificationType::Driver:
        //             $users = $this->driverRepository->getAll()->load('user');
        //             break;
        //         case \App\Enums\Notification\NotificationType::Nany:
        //             $users = $this->nanyRepository->getAll()->load('user');
        //             break;
        //         default:
        //             $users = $this->parentRepository->getAll()->load('user');
        //             break;
        //     }
        //     foreach ($users as $item) {
        //         $this->data[$objectId] = $item->id;
        //         $device_token = $item->user->device_token;
        //         $this->data['device_token'] = $device_token;

        //         $notification = $this->repository->create($this->data);
        //         if ($notification && $device_token) {
        //             $this->sendFirebaseNotification([$device_token], null, $notification->title, $notification->message);
        //         }
        //     }
        // } else {
        //     switch ($this->data['type']) {
        //         case \App\Enums\Notification\NotificationType::Driver:
        //             $item = $this->driverRepository->findOrFail($this->data[$objectId])->load('user');
        //             break;
        //         case \App\Enums\Notification\NotificationType::Nany:
        //             $item = $this->nanyRepository->findOrFail($this->data[$objectId])->load('user');
        //             break;
        //         default:
        //             $item = $this->parentRepository->findOrFail($this->data[$objectId])->load('user');
        //             break;
        //     }
        //     $notification = $this->repository->create($this->data);

        //     $device_token = $item->user->device_token;
        //     $this->data['device_token'] = $device_token;
        //     if ($notification && $device_token) {
        //         $this->sendFirebaseNotification([$device_token], null, $notification->title, $notification->message);
        //     }
        // }

        // return true; // Thông báo được xử lý thành công
    }


    public function update(Request $request): object|bool
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);
    }

    /**
     * @throws \Exception
     */
    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }

    /**
     * @throws \Exception
     */
    public function updateDeviceToken($request): JsonResponse
    {
        try {
            $data = $request->validate([
                'device_token' => 'required|string'
            ]);
            $admin = $this->getCurrentAdmin();

            if ($admin->device_token == null || $admin->device_token != $data['device_token']) {
                $this->adminRepository->update($admin->id, [
                    'device_token' => $data['device_token'],
                    'device_token_updated_at' => now()
                ]);
                return response()->json(['message' => 'Update device token success.'], 200);
            } else {
                return response()->json(['message' => 'Device token is up to date.'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update token.', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Gets notifications for admin
     *
     * @param Request $request
     * @return mixed
     */
    public function getNotifications(Request $request): mixed
    {
        $data = $request->validated();
        return $this->repository->getNotificationsByField('admin_id', $data['admin_id'], 20);
    }

    /**
     * Gets notifications for store
     *
     * @param Request $request
     * @return mixed
     */

    public function updateStatus(Request $request): JsonResponse
    {
        $data = $request->validated();

        $filters = [];
        if (!empty($data['admin_id'])) {
            $filters['admin_id'] = $data['admin_id'];
        }
        if (!empty($data['store_id'])) {
            $filters['store_id'] = $data['store_id'];
        }

        $notifications = $this->repository->getBy($filters);

        foreach ($notifications as $notification) {
            $this->repository->updateAttribute($notification->id, 'status', NotificationStatus::READ);
        }

        return response()->json(['success' => "Updated successfully"]);
    }
}
