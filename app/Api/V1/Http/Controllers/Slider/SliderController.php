<?php

namespace App\Api\V1\Http\Controllers\Slider;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Slider\SliderRequest;
use App\Api\V1\Http\Requests\Slider\SliderTypeRequest;
use App\Api\V1\Repositories\Slider\SliderRepositoryInterface;
use App\Api\V1\Http\Resources\Slider\SliderResource;
use App\Api\V1\Http\Resources\Slider\SliderResourceCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Slider
 */
class SliderController extends Controller
{

    public function __construct(
        SliderRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
        $this->middleware('auth:api');
    }

    /**
     * Chi tiết slider
     *
     * API này dùng để lấy thông tin chi tiết slider
     *
     * Các trạng thái (status) bao gồm:
     * - 1: hoạt động
     * - 2: Tạm ngưng
     *
     * Các Thể loại (type) bao gồm:
     *   - 1: Nhân viên
     *   - 2: Phụ huynh
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @queryParam key string required
     * Key của slider. Example: banner
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *        "name": "Hình ảnh",
     *        "desc": "111111111111",
     *        "items": [
     *            {
     *                "title": "Ảnh 2",
     *                "link": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                "image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                "mobile_image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg"
     *            },
     *            {
     *                "title": "Ảnh 1",
     *                "link": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                "image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                "mobile_image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg"
     *            }
     *        ]
     *    }
     * }
     *
     * @return JsonResponse
     */

    public function show(SliderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $slider = $this->repository->findByPlainKeyWithRelations($data['key']);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => new SliderResource($slider)
        ]);
    }

    /**
     * Danh sách slider
     *
     * API này dùng để lấy danh sách slider
     *
     * Các trạng thái (status) bao gồm:
     * - 1: hoạt động
     * - 2: Tạm ngưng
     *
     * Các Thể loại (type) bao gồm:
     *  - 1: Nhân viên
     *  - 2: Phụ huynh
     *
     * @authenticated
     * Example: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvMjczNi1BcHBEdWFSdW9jL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNzE5NDU0ODM5LCJleHAiOjE3MjQ2Mzg4MzksIm5iZiI6MTcxOTQ1NDgzOSwianRpIjoiZG5NWXE4d2dWTWFkOFNCdiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uGA0ylhxwMxq8zBOsDEmSGrE97LHQxSn811jl3BLrK4
     *
     * @queryParam type int optional Thể loại. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *        {
     *            "name": "Hình ảnh",
     *            "desc": "111111111111",
     *            "items": [
     *                {
     *                    "title": "Ảnh 2",
     *                    "link": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                    "image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                    "mobile_image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg"
     *                },
     *                {
     *                    "title": "Ảnh 1",
     *                    "link": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                    "image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                    "mobile_image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg"
     *                }
     *            ]
     *        },
     *        {
     *            "name": "Phạm Minh Mạnh",
     *            "desc": "ASDASD",
     *            "items": [
     *                {
     *                    "title": "TEST",
     *                    "link": "#",
     *                    "image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg",
     *                    "mobile_image": "http://localhost:8080/2736-AppDuaRuoc/public/uploads/images/1.jpeg"
     *                }
     *            ]
     *        }
     *    ]
     * }
     *
     * @return JsonResponse
     */

    public function view(SliderTypeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $sliders = $this->repository->getBy(
            [
                'type' => $data['type']
            ],
        );
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => new SliderResourceCollection($sliders)
        ]);
    }
}
