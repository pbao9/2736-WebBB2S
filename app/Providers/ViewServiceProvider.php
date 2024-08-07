<?php

namespace App\Providers;

use App\View\Composers\Menu\LocationFooterMenuComposer;
use App\View\Composers\Menu\LocationHeaderMenuComposer;
use App\View\Composers\Menu\LocationShoppingGuideMenuComposer;
use App\View\Composers\Product\FilterProductComposer;
use App\View\Composers\Product\NewProductComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\Setting\SettingComposer;
use App\View\Composers\Post\PostComposer;
use App\View\Composers\ShoppingCart\ShoppingCartComposer;
use App\View\Composers\Slider\SliderComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer([
            'public.layouts.footer',
            'public.layouts.head',
            'public.layouts.header',
            // 'public.contact.index',
            // 'public.policy.index',
            // 'public.products.partials.related-products',
            // 'public.products.show',
        ], SettingComposer::class);

        // View::composer(['public.layouts.header'], LocationHeaderMenuComposer::class);
        // View::composer(['public.layouts.footer'], LocationFooterMenuComposer::class);

        // View::composer(['public.home.partials.products'], NewProductComposer::class);
        // View::composer(['public.products.partials.filter'], FilterProductComposer::class);
        // View::composer(['public.layouts.footer'], LocationShoppingGuideMenuComposer::class);
        // View::composer(['public.home.partials.slider', 'public.home.partials.blog', 'public.home.partials.gallery'], SliderComposer::class);
        // View::composer(['public.home.partials.news'], PostComposer::class);
        // View::composer(['public.layouts.components.floating-cart'], ShoppingCartComposer::class);

        View::composer(['public.layouts.header', 'public.layouts.footer', 'public.car.index', 'public.layouts.head','mails.include.sign', 'public.components.floating-button', 'public.contact.index', 'public.blog.include.lien-he','public.blog.blog-2','public.blog.blog-3'], SettingComposer::class);
    }
}
