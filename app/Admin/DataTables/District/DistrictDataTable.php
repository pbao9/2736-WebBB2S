<?php

namespace App\Admin\DataTables\District;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\District\DistrictRepositoryInterface;


class DistrictDataTable extends BaseDataTable
{


    protected $nameTable = 'districtTable';

    protected array $actions = ['reset', 'reload'];

    public function __construct(
        DistrictRepositoryInterface $repository
    ) {
        $this->repository = $repository;

        parent::__construct();

    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.district.datatable.action',
            'name' => 'admin.district.datatable.name',
            'province' => 'admin.district.datatable.province',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2];
    }

    public function query()
    {
        return $this->repository->getByQueryBuilder([], ['province']);
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.district', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'province_code' => $this->view['province'],
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
        $this->customRawColumns = ['name', 'action', 'province_code'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'province_code' => function ($query, $keyword) {
                $query->whereHas('province', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
