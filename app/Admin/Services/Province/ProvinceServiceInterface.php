<?php

namespace App\Admin\Services\Province;
use Illuminate\Http\Request;

interface ProvinceServiceInterface
{

    public function store(Request $request);

    public function update(Request $request);

    public function delete($id);

}