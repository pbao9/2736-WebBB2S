<?php
return [
    'frontend_url' => env('APP_URL'),
    'prefix_url' => [
        'category' => '/category',
        'page' => '/page',
        'post' => '/blog',
        'tag' => '/tag'
    ],
    'images' => [
        'favicon' => '/public/assets/images/favi-icon.png',
        'avatar' => '/public/assets/images/avatar-user.png',
        'default' => '/public/assets/images/default-image.png',
        'logo' => '/public/assets/images/logo.png',
        'norecord' => '/public/assets/images/norecord.svg'
    ],
    'format' => [
        'datetime' => 'd-m-Y H:i',
        'date' => 'd-m-Y',
        'position_currency' => 'left'
    ],
    'currency' => '$',
    'sliders' => [
        'banner-1-slider' => 'slider-1',
        'banner-2-slider' => 'slider-2',
        'blog-slider' => 'slider-3',
    ],
];
