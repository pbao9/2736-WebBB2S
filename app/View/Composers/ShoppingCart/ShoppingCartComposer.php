<?php

namespace App\View\Composers\ShoppingCart;

use App\Http\Resources\ShoppingCartResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShoppingCartComposer
{
    protected $repo;

    public function __construct()
    {
        $this->repo = app()->make('App\Repositories\ShoppingCart\ShoppingCartRepositoryInterface');
    }

    public function compose(View $view): void
    {
        $shoppingCarts = $this->repo->getBy(['user_id' => auth()->id()],
            ['product', 'productVariationsLeft', 'productVariationsRight']);
        if (Auth::check()) {
            $user = Auth::user();
            $shoppingCarts = new ShoppingCartResource($shoppingCarts, $user->roles->value);
        }
        $view->with('shopping_carts', $shoppingCarts->toArray(request()));
    }
}
