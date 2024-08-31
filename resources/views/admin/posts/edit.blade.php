@extends('admin.layouts.master')
@push('libs-css')
@endpush
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <x-form :action="route('admin.post.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$post->id" />
                <div class="row justify-content-center">
                    @include('admin.posts.forms.edit-left')
                    @include('admin.posts.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')

            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
<script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
@include('ckfinder::setup')
@endpush

@push('custom-js')

@endpush
