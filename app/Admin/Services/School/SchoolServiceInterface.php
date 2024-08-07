<?php

namespace App\Admin\Services\School;
use Illuminate\Http\Request;

interface SchoolServiceInterface
{

    public function store(Request $request);

    public function update(Request $request);

    public function delete($id);

}