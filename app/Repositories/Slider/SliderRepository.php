<?php

namespace App\Repositories\Slider;

use App\Admin\Repositories\Slider\SliderRepository as AdminSliderRepository;
use App\Models\Slider;
use App\Repositories\Slider\SliderRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class SliderRepository extends AdminSliderRepository implements SliderRepositoryInterface
{
    public function getBy(array $filter, array $relations = [])
    {
        $response = $this->instance = $this->getByQueryBuilder($filter, $relations)->get();

        return $response;
    }
}
