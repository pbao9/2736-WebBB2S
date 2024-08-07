<?php

namespace App\Admin\Http\Controllers\School;

use App\Admin\DataTables\School\SchoolDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\School\SchoolRequest;
use App\Admin\Repositories\District\DistrictRepository;
use App\Admin\Repositories\Province\ProvinceRepository;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Admin\Services\School\SchoolServiceInterface;
use App\Enums\School\SchoolStatus;
use App\Imports\SchoolImport;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class SchoolController extends Controller
{
    protected ProvinceRepository $repoProvince;
    protected DistrictRepository $repoDistrict;

    public function __construct(
        SchoolRepositoryInterface $repository,
        ProvinceRepository $repoProvince,
        DistrictRepository $repoDistrict,
        SchoolServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->repoProvince = $repoProvince;
        $this->repoDistrict = $repoDistrict;
        $this->service = $service;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.school.index',
            'create' => 'admin.school.create',
            'edit' => 'admin.school.edit'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.school.index',
            'create' => 'admin.school.create',
            'edit' => 'admin.school.edit',
            'delete' => 'admin.school.delete'
        ];
    }
    public function index(SchoolDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('school'))
        ]);
    }

    public function create(): Factory|View|Application
    {
        $provinces = $this->repoProvince->get2Province();
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('school'),
                route($this->route['index'])
            )->add(__('add')),
            'provinces' => $provinces,
        ]);
    }

    public function store(SchoolRequest $request): RedirectResponse
    {

        $response = $this->service->store($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    /**
     * @throws Exception
     */
    public function edit($id): Factory|View|Application
    {
        $instance = $this->repository->findOrFail($id);
        $provinces = $this->repoProvince->get2Province();
        $district = $this->repoDistrict->findBy(['code' => $instance->district_code]);
        return view(
            $this->view['edit'],
            [
                'school' => $instance,
                'provinces' => $provinces,
                'currentDistrict' => $instance->district_code,
                'districts' => $district,
                'status' => SchoolStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('school'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    public function update(SchoolRequest $request): RedirectResponse
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

    // Import excel truong hoc
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv|max:2048',
        ]);

        $file = $request->file('file');
        // Log::info('File details', ['file' => $file]);
        if ($file->isValid()) {
            try {
                Excel::import(new SchoolImport, $file);
                return redirect()->back()->with('success', __('uploadSuccess'));
            } catch (ValidationException $e) {
                $failures = $e->failures();
                $errorMessages = [];
                foreach ($failures as $failure) {
                    $errorMessages[] = $failure->errors();
                }
                return redirect()->back()->with('error', 'Nhập file thất bại, kiểm tra lại!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Kiểm tra lại: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', __('uploadFail'));
        }
    }
}
