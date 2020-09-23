@extends('core::admin.master')

@section('meta_title', __('customer::address.index.page_title'))

@section('page_title', __('customer::address.index.page_title'))

@section('page_subtitle', __('customer::address.index.page_subtitle'))

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('customer::address.index.breadcrumb') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">
                        {{ __('customer::address.index.page_title') }}
                    </h6>
                </div>
                <div class="text-right">
                    <div class="actions">
	                    @admincan('customer.admin.address.create')
	                        <a href="{{ route('customer.admin.address.create') }}" class="action-item">
	                            <i class="fa fa-plus"></i>
	                            {{ __('core::button.add') }}
	                        </a>
                        @endadmincan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap bootstrap4-styling">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('customer::address.name') }}</th>
                    <th>{{ __('customer::address.email') }}</th>
                    <th>{{ __('customer::address.phone') }}</th>
                    <th>{{ __('customer::address.created_at') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('customer.admin.address.edit', $item->id) }}">
                                {{ $item->customer->name }}
                            </a>
                        </td>
                        <td>{{ $item->customer->email }}</td>
                        <td>{{ $item->customer->phone }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="text-right">
                        	@admincan('customer.admin.address.edit')
	                            <a href="{{ route('customer.admin.address.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1">
	                                <i class="fas fa-pencil-alt"></i>
	                            </a>
                            @endadmincan

                            @admincan('customer.admin.address.destroy')
                            	<table-button-delete url-delete="{{ route('customer.admin.address.destroy', $item->id) }}"></table-button-delete>
                            @endadmincan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--{!! $items->appends(Request::all())->render() !!}--}}
        </div>
    </div>
@stop
