<?php

namespace App\Admin\DataTables\Province;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Enums\Province\ProvinceActive;
use App\Enums\School\SchoolStatus;


class ProvinceDataTable extends BaseDataTable
{


    protected $nameTable = 'provinceTable';

    protected array $actions = ['reset', 'reload'];

    public function __construct(
        ProvinceRepositoryInterface $repository
    ) {
        $this->repository = $repository;

        parent::__construct();

    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.province.datatable.action',
            'name' => 'admin.province.datatable.name',
            'active' => 'admin.province.datatable.active',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => ProvinceActive::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.province', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'active' => $this->view['active'],
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
        $this->customRawColumns = ['name', 'action', 'active'];
    }


}
