<?php

namespace App\Admin\Http\Controllers\Address\Address\District;

use App\Admin\DataTables\District\DistrictDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\District\DistrictRequest;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Services\District\DistrictServiceInterface;
use App\Enums\District\DivisonTypeDistrict;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct(
        DistrictRepositoryInterface $repository,
        DistrictServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.district.index',
            'create' => 'admin.district.create',
            'edit' => 'admin.district.edit'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.district.index',
            'create' => 'admin.district.create',
            'edit' => 'admin.district.edit',
            'delete' => 'admin.district.delete'
        ];
    }

    public function index(DistrictDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('district'))
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view($this->view['create'], [
            'divisionType' => DivisonTypeDistrict::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('district'), route($this->route['index']))->add(__('add')),
        ]);
    }

    public function store(DistrictRequest $request): RedirectResponse
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
                'district' => $instance,
                'divisionType' => DivisonTypeDistrict::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('district'), route($this->route['index']))->add(__('update')),
            ],
        );
    }

    public function update(DistrictRequest $request): RedirectResponse
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
