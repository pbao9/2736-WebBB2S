
@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">@lang('list') Module</h2>
                    <x-link :href="route('admin.module.create')" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        <span class="ms-1">@lang('add')</span>
                    </x-link>
                </div>
                <div class="card-body">
                    <p><strong>Lưu ý</strong>: Đây là phần chỉ dành riêng cho Nhà phát triển. Các Dev sẽ sử dụng Slug ( Permission_name ) để lập trình, đóng gói các chức năng để có thể phân quyền. Vui lòng <b>không xóa hoặc điều chỉnh</b> các Quyền nếu bạn không phải Dev hoặc không biết về nó để tránh bị Lỗi toàn bộ hệ thống.  </p>
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{$dataTable->table(['class' => 'table table-bordered'], true)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('libs-js')
    <!-- button in datatable -->
    <script src="{{ asset('/public/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('custom-js')

    {{ $dataTable->scripts() }}

    @include('admin.scripts.datatable-toggle-columns', [
        'id_table' => $dataTable->getTableAttribute('id')
    ])

@endpush

