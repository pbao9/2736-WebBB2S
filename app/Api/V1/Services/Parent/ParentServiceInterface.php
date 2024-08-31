<?php

namespace App\Api\V1\Services\Parent;

use Illuminate\Http\Request;

interface ParentServiceInterface
{
    public function getTripsByParent(Request $request);

    public function tripDetail(Request $request);

}
