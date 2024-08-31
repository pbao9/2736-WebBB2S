<h2 class=" text-dark fw-bold text-uppercase title-sidebar pb-2">Sản phẩm khác</h2>
@foreach ($allproduct as $item)
    <x-link :href="route('product.show', $item->slug)" class="text-decoration-none">
        <span class="text-start nav-link mt-3 text-uppercase text-dark">{{ __($item->title) }}</span>
    </x-link>
@endforeach
