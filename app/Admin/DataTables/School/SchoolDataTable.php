<?php

namespace App\Admin\DataTables\School;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Enums\School\SchoolStatus;


class SchoolDataTable extends BaseDataTable
{


    protected $nameTable = 'schoolTable';

    protected array $actions = ['reset', 'reload', 'excel'];

    public function __construct(
        SchoolRepositoryInterface $repository
    )
    {
        $this->repository = $repository;

        parent::__construct();

    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.school.datatable.action',
            'name' => 'admin.school.datatable.name',
            'province' => 'admin.school.datatable.province',
            'district' => 'admin.school.datatable.district',
            'status' => 'admin.school.datatable.status',
            'student-details' => 'admin.school.datatable.student-details'

        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5];

        $this->columnSearchDate = [4];

        $this->columnSearchSelect = [

            [
                'column' => 5,
                'data' => SchoolStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository->getByQueryBuilder([], ['province', 'district']);
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.school', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'status' => $this->view['status'],
            'province_code' => $this->view['province'],
            'district_code' => $this->view['district'],
            'created_at' => '{{ format_date($created_at) }}',
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'student-details' => $this->view['student-details'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['name', 'action', 'student-details', 'province', 'district','status'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'province_code' => function ($query, $keyword) {
                $query->whereHas('province', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                });
            },
            'district_code' => function ($query, $keyword) {
                $query->whereHas('district', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
