<?php

namespace App\Admin\Http\Controllers\School;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Admin\Http\Resources\School\SchoolSearchSelectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SchoolSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        SchoolRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => SchoolSearchSelectResource::collection($this->instance)
        ];
    }

    // public function getSchoolsByDistrict(Request $request): JsonResponse
    // {
    //     $districtCode = $request->input('district_code');

    //     $schools = $this->repository->searchAllLimit('', [], null, $districtCode);

    //     return response()->json([
    //         'results' => SchoolSearchSelectResource::collection($schools),
    //     ]);
    // }
    public function getSchoolsByDistrict(Request $request): JsonResponse
    {
        $districtCode = $request->input('district_code');

        // Log giá trị của districtCode
        Log::info('Selected District Code: ' . $districtCode);

        // Gọi phương thức searchAllLimit để lấy danh sách trường
        $schools = $this->repository->searchAllLimit('', [], null, $districtCode);

        return response()->json([
            'results' => SchoolSearchSelectResource::collection($schools),
        ]);
    }
}
