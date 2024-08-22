<?php

namespace App\Admin\Http\Controllers\Address\Address\Province;

use App\Admin\DataTables\Province\ProvinceDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Province\ProvinceRequest;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Admin\Services\Province\ProvinceServiceInterface;
use App\Enums\Province\DivisonType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function __construct(
        ProvinceRepositoryInterface $repository,
        ProvinceServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.province.index',
            'create' => 'admin.province.create',
            'edit' => 'admin.province.edit'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.province.index',
            'create' => 'admin.province.create',
            'edit' => 'admin.province.edit',
            'delete' => 'admin.province.delete'
        ];
    }

    public function index(ProvinceDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('province'))
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view($this->view['create'], [
            'divisionType' => DivisonType::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('province'), route($this->route['index']))->add(__('add')),
        ]);
    }

    public function store(ProvinceRequest $request): RedirectResponse
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
        $instance = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'province' => $instance,
                'divisionType' => DivisonType::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('province'), route($this->route['index']))->add(__('update')),
            ],
        );
    }

    public function update(ProvinceRequest $request): RedirectResponse
    {

        $response = $this->service->update($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? back()->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id): RedirectResponse
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
