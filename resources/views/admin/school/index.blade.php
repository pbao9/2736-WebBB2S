@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="d-flex flex-column">
                        <h2 class="mb-0">@lang('Danh sách trường học')</h2>
                        <div class="d-flex flex-row gap-2">
                            <div class="d-flex flex-column">
                                <p class="mb-1">{{ __('Tải lên File trường học') }}</p>
                                <x-form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="d-flex gap-2">
                                        <input id="school-file" type="file" name="file" class="hidden form-control"
                                        accept=".xlsx, .xls, .csv, .ods">
                                        <button type="submit" class="btn btn-cyan">Tải lên</button>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <x-link :href="route('admin.school.download')" class="btn btn-success">
                            <i class="ti ti-download"></i>
                            <span class="ms-1">{{ __('Tải file mẫu') }}</span>
                        </x-link>
                        <x-link :href="route('admin.school.create')" class="btn btn-primary">
                            <i class="ti ti-plus"></i>
                            <span class="ms-1">@lang('add')</span>
                        </x-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{ $dataTable->table(['class' => 'table table-bordered'], true) }}
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
        'id_table' => $dataTable->getTableAttribute('id'),
    ])
@endpush
