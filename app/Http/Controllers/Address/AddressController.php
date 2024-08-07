<?php

namespace App\Http\Controllers\Address;

use App\Admin\Http\Controllers\Controller;

use App\Models\District;
use App\Models\Province;
use App\Models\School;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Handle the event of province selection and retrieve corresponding districts.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getDistrictsByProvince(Request $request): JsonResponse
    {

        $province = Province::where('code', $request->province_code)->first();

        if (!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }

        $districts = $province->district()->get();

        return response()->json($districts);
    }

    public function getWardsByDistrict(Request $request): JsonResponse
    {

        $district = District::where('code', $request->district_code)->first();

        if (!$district) {
            return response()->json(['message' => 'District not found'], 404);
        }

        $wards = $district->wards()->get();

        return response()->json($wards);
    }
    
    public function getSchoolsByDistrict(Request $request): JsonResponse
    {
        $district = District::where('code', $request->district_code)->first();

        if (!$district) {
            return response()->json(['message' => 'District not found'], 404);
        }

        $schools = $district->school()->get();

        return response()->json($schools);
    }
}
