@extends('core::admin.master')

@section('meta_title', __('customer::group.index.page_title'))

@section('page_title', __('customer::group.index.page_title'))

@section('page_subtitle', __('customer::group.index.page_subtitle'))

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('customer::group.index.breadcrumb') }}</li>
        </ol>
    </nav>
@stop

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('customer::group.index.breadcrumb') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('customer::group.create.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fs-17 font-weight-600 mb-0">
                        {{ __('customer::group.index.page_title') }}
                    </h5>
                </div>
                <div class="text-right">
                    <div class="actions">
	                    @admincan('customer.admin.group.create')
	                        <a href="{{ route('customer.admin.group.create') }}" class="action-item">
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
                    <th>{{ __('customer::group.name') }}</th>
                    <th>{{ __('customer::group.created_at') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('customer.admin.group.edit', $item->id) }}">
                                {{ $item->name }}
                            </a>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td class="text-right">
                            @admincan('customer.admin.group.edit')
                                <a href="{{ route('customer.admin.group.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                    <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -6px; margin-top: 4px"></i>
                                </a>
                            @endadmincan
                            @admincan('customer.admin.group.destroy')
                                <button-delete url-delete="{{ route('customer.admin.group.destroy', $item->id) }}"></button-delete>
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
