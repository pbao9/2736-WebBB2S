<?php

namespace App\Http\Controllers\School;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Http\Resources\School\SchoolSearchSelectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class SchoolSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        SchoolRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getSchoolsByDistrict(Request $request): JsonResponse
    {
        $districtCode = $request->input('district_code');
        $schools = $this->repository->searchAllLimit('', [], 0, $districtCode);

        return response()->json([
            'results' => SchoolSearchSelectResource::collection($schools),
        ]);
    }

}
