@extends('public.layouts.master')
@section('content')

    @include('public.home.include.slider')
    @include('public.home.include.section-1')

    <div class="container">
        @include('public.home.include.section-2')
    </div>
    @include('public.home.include.section-3')
    @include('public.home.include.section-4')
    @include('public.home.include.section-5')
@endsection
