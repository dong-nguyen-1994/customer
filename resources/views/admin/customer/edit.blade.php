@extends('core::admin.master')

@section('meta_title', __('customer::customer.edit.page_title'))

@section('page_title', __('customer::customer.edit.page_title'))

@section('page_subtitle', __('customer::customer.edit.page_subtitle'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.admin.customer.index') }}">{{ trans('customer::customer.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('customer::customer.edit.breadcrumb') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('customer::customer.edit.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

{{--@assetadd('address-script', asset("vendor/customer/js/admin/address.js"), ['jquery'])--}}

@section('content')
    <div class="mr-2 ml-2">
        <form action="{{ route('customer.admin.customer.update', $item->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fs-17 font-weight-600 mb-2">
                            {{ __('customer::customer.edit.page_title') }} "{{ $item->name }}"
                        </h4>
                    </div>
                    <div class="text-right">
                        <div class="btn-group">
                            <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
                            <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('customer::admin.customer._fields', ['item' => $item])
            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <button class="btn btn-success" type="submit">{{ __('core::button.submit') }}</button>
                    <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                </div>
            </div>
        </div>

    </form>
    </div>
    @include('customer::admin.customer.modals.delete')
@stop
