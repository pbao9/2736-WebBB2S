<?php



namespace App\Admin\Http\Resources\District;

use App\Admin\Http\Resources\Province\ProvinceSearchSelectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictSearchSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->code,
            'text' => $this->name,
        ];
    }
}
