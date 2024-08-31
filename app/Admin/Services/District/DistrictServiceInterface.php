<?php

namespace App\Admin\Services\District;
use Illuminate\Http\Request;

interface DistrictServiceInterface
{

    public function store(Request $request);

    public function update(Request $request);

    public function delete($id);

}