<?php

namespace App\Api\V1\Repositories\Slider;
use App\Admin\Repositories\Slider\SliderRepository as AdminSliderRepository;

class SliderRepository extends AdminSliderRepository implements SliderRepositoryInterface
{
    public function findByPlainKeyWithRelations($key, $relations = ['items'])
    {
        $this->instance = $this->model->where('plain_key', $key)->active()->firstOrFail();
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }
}