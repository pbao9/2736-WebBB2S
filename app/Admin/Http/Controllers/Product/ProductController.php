<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\DataTables\Product\ProductDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Product\ProductRequest;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Admin\Traits\ResponseController;
use App\Enums\Product\ProductStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    use ResponseController;

    public function __construct(
        ProductRepositoryInterface         $repository,
        ProductServiceInterface            $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'edit' => 'admin.product.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'edit' => 'admin.product.edit',
            'delete' => 'admin.product.delete'
        ];
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('product'), route($this->route['index'])),
            'status' => ProductStatus::asSelectArray(),
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('product'), route($this->route['index']))->add(__('add')),
            'status' => ProductStatus::asSelectArray()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $response = $this->service->store($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id): Factory|View|Application
    {
        $product = $this->repository->findOrFailWithRelations($id);
        return view(
            $this->view['edit'],
            [
                'product' => $product,
                'status' => ProductStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('product'), route($this->route['index']))->add(__('edit')),
            ],
        );
    }

    public function update(ProductRequest $request): RedirectResponse
    {
        $response = $this->service->update($request);
        return $this->handleUpdateResponse($response);
    }

    public function delete($id): RedirectResponse
    {
        $this->service->delete($id);
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
