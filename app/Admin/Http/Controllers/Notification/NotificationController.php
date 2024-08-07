<?php

namespace App\Admin\Http\Controllers\Notification;

use App\Admin\DataTables\Notification\NotificationDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Notification\NotificationRequest;
use App\Admin\Repositories\Driver\DriverRepositoryInterface;
use App\Admin\Repositories\Nany\NanyRepositoryInterface;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\Parent\ParentRepositoryInterface;
use App\Admin\Services\Notification\NotificationServiceInterface;
use App\Enums\Notification\NotificationStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    protected $repositoryDriver;
    protected $repositoryParent;
    protected $repositoryNany;

    public function __construct(
        NotificationRepositoryInterface $repository,
        NotificationServiceInterface    $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.notifications.index',
            'create' => 'admin.notifications.create',
            'edit' => 'admin.notifications.edit'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'edit' => 'admin.notification.edit',
            'delete' => 'admin.page.delete'
        ];
    }

    public function index(NotificationDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('page'))
        ]);
    }


    public function updateDeviceToken(Request $request)
    {
        return $this->service->updateDeviceToken($request);
    }

    public function updateStatus(NotificationRequest $request)

    {
        return $this->service->updateStatus($request);
    }


    /**
     * Get notification for admin
     *
     * @param NotificationRequest $request
     * @return JsonResponse
     */
    public function getNotificationsForAdmin(NotificationRequest $request): JsonResponse
    {
        $notifications = $this->service->getNotifications($request);

        if ($notifications) {
            return response()->json([
                'notifications' => $notifications
            ]);
        }
        return response()->json([
            'notifications' => [],
            'errors' => ['Specific condition is not met']
        ], 422);
    }

    public function create(): View|Application
    {
        $drivers = $this->repositoryDriver->getAllDriver();
        $parents = $this->repositoryParent->getAllParent();
        $nannies = $this->repositoryNany->getAllNany();
        return view($this->view['create'], [
            'drivers' => $drivers,
            'parents' => $parents,
            'nannies' => $nannies,
            'status' => NotificationStatus::asSelectArray(),
            'breadcrums' => $this->crums->add(__('notifications'), route($this->route['index']))->add(__('add'))
        ]);
    }

    public function store(NotificationRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return redirect()->route($this->route['index'])->with('success', __('notifySuccess'));
        }
        else if($response == false){
            return redirect()->route($this->route['create'])->with('error', __('Chưa có một ai để gửi thông báo'));
        }
        else {
            return redirect()->route($this->route['create'])->with('error', __('notifyFail'));
        }
    }

    public function edit($id): View|Application
    {
        $response = $this->repository->findOrFail($id);
        $drivers = $this->repositoryDriver->getAllDriver();
        $parents = $this->repositoryParent->getAllParent();
        $nannies = $this->repositoryNany->getAllNany();

        return view(
            $this->view['edit'],
            [
                'drivers' => $drivers,
                'parents' => $parents,
                'nannies' => $nannies,
                'status' => NotificationStatus::asSelectArray(),
                'notification' => $response,
                'breadcrums' => $this->crums->add(__('notification'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    public function update(NotificationRequest $request): RedirectResponse
    {

        $response = $this->service->update($request);

        if ($response) {
            return back()->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }


    public function delete($id): RedirectResponse
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
