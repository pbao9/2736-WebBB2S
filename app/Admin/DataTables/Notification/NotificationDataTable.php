<?php

namespace App\Admin\DataTables\Notification;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Enums\Notification\NotificationStatus;
use App\Traits\AuthService;

class NotificationDataTable extends BaseDataTable
{
    use AuthService;

    protected $nameTable = 'notificationTable';

    protected $userRepository;

    public function __construct(
        NotificationRepositoryInterface $repository,
        UserRepositoryInterface         $userRepository,
    ) {
        $this->repository = $repository;

        $this->userRepository = $userRepository;

        parent::__construct();
    }

    public function setView()
    {
        $this->view = [
            'action' => 'admin.notifications.datatable.action',
            'title' => 'admin.notifications.datatable.title',
            'edit_link_parent' => 'admin.notifications.datatable.edit-link-parent',
            'edit_link_driver' => 'admin.notifications.datatable.edit-link-driver',
            'edit_link_nany' => 'admin.notifications.datatable.edit-link-nany',
            'status' => 'admin.notifications.datatable.status',
            'checkbox' => 'admin.notifications.datatable.checkbox',
        ];
    }

    public function setColumnSearch()
    {
        $this->columnAllSearch = [4, 5, 6];
        $this->columnSearchDate = [6];

        $this->columnSearchSelect = [
            [
                'column' => 5,
                'data' => NotificationStatus::asSelectArray(),
            ],
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        // return $this->repository->getQueryBuilderOrderBy();
        $result = $this->repository->getQueryBuilderOrderBy()
            ->select('notifications.*')
            ->with(['parent.user', 'driver.user', 'nany.user']);
        return $result;
    }

    protected function setCustomColumns()
    {
        $this->customColumns = config('datatables_columns.notifications', ['parent','driver','nany']);
    }

    protected function setCustomEditColumns()
    {
        $this->customEditColumns = [
            'title' => $this->view['title'],
            'status' => $this->view['status'],
            'parent_id' => $this->view['edit_link_parent'],
            'driver_id' => $this->view['edit_link_driver'],
            'nany_id' => $this->view['edit_link_nany'],
            'created_at' => '{{ format_date($created_at) }}',
        ];
    }

    protected function setCustomAddColumns()
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'checkbox' => $this->view['checkbox'],
        ];
    }

    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['action', 'status', 'checkbox', 'parent_id', 'nany_id', 'driver_id', 'title'];
    }

    protected function startBuilderDataTable($query)
    {
        $this->instanceDataTable = datatables()->eloquent($query)->addIndexColumn();
    }
}
