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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-8 text-sm-center form-inline">
                                <div class="form-group mr-2">
                                    <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('customer.admin.group.create') }}"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a>
                                </div>
                                <form action="">
                                    <div class="form-group">
                                        <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                        <input type="submit" value="Search" class="btn btn-secondary ml-5">
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 text-sm-right">
                                <button class="btn btn-info" data-url="" id="btnExportProduct"><i class="fa fa-download"></i>Export</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
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
                                            <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
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

                        {!! $items->appends(Request::all())->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
