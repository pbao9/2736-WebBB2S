<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Product\ProductBanner;
use App\Enums\Product\ProductStatus;
use Illuminate\Validation\Rules\Enum;

class ProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'title' => ['required', 'string'],
            'image' => ['required'],
            'banner_title' => ['nullable'],
            'banner' => ['nullable'],
            'show_banner' => ['nullable', new Enum(ProductBanner::class)],
            'status' => ['required', new Enum(ProductStatus::class)],
            'excerpt' => ['nullable'],
            'content' => ['nullable'],
            'title_seo' => ['nullable'],
            'desc_seo' => ['nullable']
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\Product,id'],
            'title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'image' => ['required'],
            'banner_title' => ['nullable'],
            'banner' => ['nullable'],
            'show_banner' => ['nullable', new Enum(ProductBanner::class)],
            'status' => ['required', new Enum(ProductStatus::class)],
            'excerpt' => ['nullable'],
            'content' => ['nullable'],
            'title_seo' => ['nullable'],
            'desc_seo' => ['nullable']
        ];
    }
}
