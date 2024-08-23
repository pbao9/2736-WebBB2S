<?php

namespace App\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Product\ProductRepositoryInterface;

class ProductController extends Controller
{

    protected $repository;

    public function __construct(
        ProductRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'index' => 'public.product.index',
            'show' => 'public.product.show',
            'blog1' => 'public.blog.blog-1',
            'blog2' => 'public.blog.blog-2',
            'blog3' => 'public.blog.blog-3'
        ];
    }

    public function getRoute()
    {
        return [];
    }

    public function index()
    {

        $products = $this->repository->paginate([], [], []);
        $breadcrums = [['label' => trans('Sản phẩm')]];

        return view(
            $this->view['index'],
            [
                'products' => $products,
                'breadcrums' => $breadcrums,

            ]
        );
    }

    public function show($slug)
    {

        $products = $this->repository->findBy(['slug' => $slug], ['products']);
        $allProduct = $this->repository->getByLimit([], []);

        if (!$products) {
            abort(404, 'Post not found');
        }

        $products->viewed += 1;
        $products->save();

        $breadcrums = [
            ['label' => $products->title]
        ];

        // $related = $this->repository->getByLimit([
        //     ['id', '!=', $products->id]
        // ], [
        //     'categories' => fn($q) => $q->whereIn('id', $products->categories->pluck('id')->toArray())
        // ], [], 5);

        return view($this->view['show'], [
            'product' => $products,
            // 'related' => $related,
            'allproduct' => $allProduct,
            'breadcrums' => $breadcrums,
        ]);
    }


    public function blog1(){
        return view('public.blog.blog-1');
    }
}
