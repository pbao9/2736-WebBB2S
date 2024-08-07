<?php

namespace App\Admin\DataTables\Contact;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Contact\ContactRepositoryInterface;
use App\Enums\Contact\ContactStatus;
use App\Enums\Contact\ContactType;

class ContactDataTable extends BaseDataTable
{
    protected $nameTable = 'contactTable';


    public function __construct(
        ContactRepositoryInterface $repository
    ) {
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.contact.datatable.action',
            'name' => 'admin.contact.datatable.name',
            'form_type' => 'admin.contact.datatable.form_type',
            'status' => 'admin.contact.datatable.status',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3];

        $this->columnSearchDate = [3];

        $this->columnSearchSelect = [
            [
                'column' => 1,
                'data' => ContactType::asSelectArray()
            ],
            [
                'column' => 2,
                'data' => ContactStatus::asSelectArray()
            ],

        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.contact', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'created_at' => '{{ format_date($created_at) }}',
            'form_type' => $this->view['form_type'],
            'status' => $this->view['status'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['name', 'action', 'form_type', 'status'];
    }
}
