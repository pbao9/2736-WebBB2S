@extends('public.layouts.master')


@section('content')
<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="empty">
          <div class="empty-img">
            @include('public.components.empty-img')
          </div>
          <p class="empty-title">Có lẽ chúng ta đã gặp vấn đề gì đó!</p>
          <p class="empty-subtitle text-secondary">
            Không thể tìm kiếm hoặc đã bị xoá chức năng này!
          </p>
          <div class="empty-action">
            <x-link :href="route('home.index')" class="btn btn-cyan">
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path><path d="M5 12l6 6"></path><path d="M5 12l6 -6"></path></svg>
              Trở về trang chủ
            </x-li>
          </div>
        </div>
      </div>
    </div>  
</body>
@endsection