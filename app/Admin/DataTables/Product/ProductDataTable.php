<?php

namespace App\Admin\DataTables\Product;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Traits\GetConfig;
use App\Enums\Product\ProductStatus;

class ProductDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'ProductTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct(
        ProductRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.product.datatable.action',
            'image' => 'admin.product.datatable.image',
            'editlink' => 'admin.product.datatable.editlink',
            'status' => 'admin.product.datatable.status',
            // 'is_featured' => 'admin.product.datatable.is-featured'
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [1, 2, 3, 4];

        $this->columnSearchDate = [4];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => ProductStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }


    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.product', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'image' => $this->view['image'],
            'status' => $this->view['status'],
            'title' => $this->view['editlink'],
            // 'is_featured' => $this->view['is_featured'],
            'created_at' => '{{ date("d-m-Y", strtotime($created_at)) }}',
            'updated_at' => '{{ date("d-m-Y", strtotime($updated_at)) }}',
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
        $this->customRawColumns = ['image', 'title', 'status', 'action'];
    }


}
