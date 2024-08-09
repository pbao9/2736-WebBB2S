@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">{{ __('Danh sách bài viết') }}</h2>
                    <x-link :href="route('admin.post.create')" class="btn btn-primary"><i class="ti ti-plus"></i>{{ __('Thêm bài viết') }}</x-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{$dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true)}}
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
