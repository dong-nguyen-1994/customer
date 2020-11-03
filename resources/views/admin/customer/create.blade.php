@extends('core::admin.master')

@section('meta_title', __('customer::customer.create.page_title'))

@section('page_title', __('customer::customer.create.page_title'))

@section('page_subtitle', __('customer::customer.create.page_subtitle'))

@push('scripts')
    <script src="vendor/customer/js/admin/customer.js"></script>
@endpush

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.admin.customer.index') }}">{{ trans('customer::customer.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('customer::customer.create.breadcrumb') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('customer::customer.create.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('customer.admin.customer.store') }}" method="POST">
        @csrf

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fs-17 font-weight-600 mb-0">
                            {{ __('customer::customer.create.page_title') }}
                        </h5>
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
                @include('customer::admin.customer._fields', ['item' => null])
            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <button class="btn btn-success" type="submit">{{ __('core::button.submit') }}</button>
                    <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                </div>
            </div>
        </div>
    </form>
@stop
