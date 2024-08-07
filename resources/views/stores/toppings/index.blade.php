@extends('admin.layouts.master')

@push('libs-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.bootstrap5.min.css">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
            <div class="card-header justify-content-between">
                    <h2 class="mb-0">@lang('listtopping')</h2>
                    <x-link :href="route('admin.topping.create')" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        <span class="ms-1">@lang('add')</span>
                    </x-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{ $dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true) }}
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

    @include('stores.toppings.scripts.datatable-toggle-columns', [
        'id_table' => $dataTable->getTableAttribute('id'),
    ])
@endpush
