<?php

namespace App\Admin\Http\Controllers\Contact;

use App\Admin\DataTables\Contact\ContactDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Contact\ContactRequest;
use App\Admin\Repositories\Contact\ContactRepositoryInterface;
use App\Admin\Repositories\District\DistrictRepository;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Admin\Repositories\Ward\WardRepositoryInterface;
use App\Admin\Services\Contact\ContactServiceInterface;
use App\Enums\Contact\ContactStatus;
use App\Enums\Contact\ContactType;
use App\Enums\Contact\UserType;
use App\Enums\Session\Session;
use App\Models\Province;
use App\Models\School;

class ContactController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;
    protected $schoolRepository;

    public function __construct(
        ContactRepositoryInterface $repository,
        ContactServiceInterface $service,
        SchoolRepositoryInterface $schoolRepository,
        ProvinceRepositoryInterface $provinceRepository,
        DistrictRepository $districtRepository,
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->schoolRepository = $schoolRepository;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.contact.index',
            'create' => 'admin.contact.create',
            'edit' => 'admin.contact.edit'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.contact.index',
            'create' => 'admin.contact.create',
            'edit' => 'admin.contact.edit',
            'delete' => 'admin.contact.delete'
        ];
    }
    public function index(ContactDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('contact'))
        ]);
    }

    public function create()
    {
        $provinces = $this->provinceRepository->getAll();
        return view($this->view['create'], [
            'breadcrums' => $this->crums->add(__('contact'), route($this->route['index']))->add(__('add')),
            'form_type' => ContactType::asSelectArray(),
            'provinces' => $provinces,
            'type' => UserType::asSelectArray()
        ]);
    }

    public function store(ContactRequest $request)
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
    public function edit($id)
    {
        $contact = $this->repository->findOrFail($id);
        $school = School::find($contact->school_id);
        $school = $this->schoolRepository->findBy(['id' => $contact->school_id]);
        $province = $this->provinceRepository->findBy(['code' => $contact->province_code]);
        $district = $this->districtRepository->findBy(['code' => $contact->district_code]);

        return view(
            $this->view['edit'],
            [
                'contact' => $contact,
                'school' => $school,
                'province' => $province,
                'district' => $district,
                'currentDistrict' => $contact->district_code,
                'currentWard' => $contact->ward_code,
                'form_type' => ContactType::asSelectArray(),
                'type' => UserType::asSelectArray(),
                'status' => ContactStatus::asSelectArray(),
                'session' => Session::asSelectArray(),
                'breadcrums' => $this->crums->add(__('contact'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    public function update(ContactRequest $request)
    {

        $response = $this->service->update($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? back()->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
