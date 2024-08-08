@extends('public.layouts.master')

@section('content')
    <section id="activism_section" class="activism-section">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-9 col-12">
                    <h1 class="title-section mb-3 mt-2" style="font-size: 2em">Tin Tức
                    </h1>
                    <div class="blog">
                        <div class="row">
                            @foreach ($posts as $item)
                                <div class="col-md-4 text-center">
                                    <x-link :href="route('blog.show', $item->slug)">
                                        <img src="{{ asset($item->image) }}"
                                            class="w-100 h-100 object-cover card-img-start img-fluid " alt="Bài Post">
                                        </x-li>
                                        <span class="text-uppercase fw-bold text-center">
                                            {{ $item->title }}
                                        </span>
                                </div>
                            @endforeach

                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    {{ $posts->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
