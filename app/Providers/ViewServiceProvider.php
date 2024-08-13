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
        ], SettingComposer::class);

        View::composer(['public.home.include.slider'], SliderComposer::class);

        View::composer(['public.layouts.header', 'public.layouts.footer', 'public.car.index', 'public.layouts.head', 'mails.include.sign', 'public.components.floating-button', 'public.contact.index', 'public.blog.include.lien-he', 'public.blog.blog-2', 'public.blog.blog-3', 'mails.contact-form'], SettingComposer::class);
    }
}
