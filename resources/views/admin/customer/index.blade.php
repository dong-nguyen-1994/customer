@extends('core::admin.master')

@section('meta_title', __('customer::customer.index.page_title'))

@section('page_title', __('customer::customer.index.page_title'))

@section('page_subtitle', __('customer::customer.index.page_subtitle'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('customer::customer.index.page_title') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">Collapsed Sidebar</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="header-title">Add &amp; Remove Rows</h4>
                <p class="sub-header">
                    Add or remove rows from your FooTable.
                </p>

                <div class="mb-2">
                    <div class="row">
                        <div class="col-12 text-sm-center form-inline">
                            <div class="form-group mr-2">
                                <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('customer.admin.customer.create') }}"><i class="mdi mdi-plus-circle mr-2"></i> Add New Row</a>
                            </div>
                            <div class="form-group">
                                <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
                <thead>
                <tr>
                    <th>
                        <div class="checkbox checkbox-primary">
                            <input id="group" name="group2" onclick="checkCustomerItem('group', 'itemCustomer');" type="checkbox">
                            <label for="group"></label>
                        </div>
                    </th>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('customer::customer.email') }}</th>
                    <th>{{ __('customer::customer.firstname') }}</th>
                    <th>{{ __('customer::customer.lastname') }}</th>
                    <th>{{ __('customer::customer.group') }}</th>
                    <th>{{ __('customer::customer.created_at') }}</th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox{{$item->id}}" type="checkbox" class="itemCustomer" value="{{$item->id}}" onclick="isDisplayDeleteButton()">
                                <label for="checkbox{{$item->id}}"></label>
                            </div>
                        </td>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('customer.admin.customer.edit', $item->id) }}">
                                {{ $item->email }}
                            </a>
                        </td>
                        <td>{{ $item->firstname }}</td>
                        <td>{{ $item->lastname }}</td>
                        <td>{{ object_get($item, 'group.name') }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="text-right">
                        	@admincan('customer.admin.customer.edit')
	                            <a href="{{ route('customer.admin.customer.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1">
	                                <i class="fas fa-pencil-alt"></i>
	                            </a>
                            @endadmincan

                            @admincan('customer.admin.customer.destroy')
                            	<table-button-delete url-delete="{{ route('customer.admin.customer.destroy', $item->id) }}"></table-button-delete>
                            @endadmincan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $items->appends(Request::all())->render() !!}
        </div>
    </div>

    <div class="modal fade" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure delete the items?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 183px;">
                    <a href="#" class="btn btn-success deleteImageListView" id="deleteImageListView" onclick="deleteCheckedCustomerItem()">Yes</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        function isDisplayDeleteButton() {
            var baseCheck = $('.itemCustomer').is(":checked");
            $('.itemCustomer').each(function() {
                if (!$(this).is(':disabled')) {
                    if (baseCheck) {
                        $('#btnDeleteCustomer').css('display', 'inline');
                    } else {
                        $('#btnDeleteCustomer').css('display', 'none');
                    }
                }
            });
        }
        function checkCustomerItem(baseId, itemClass) {
            var baseCheck = $('#' + baseId).is(":checked");
            if (baseCheck) {
                $('#btnDeleteCustomer').css('display', 'inline');
            } else {
                $('#btnDeleteCustomer').css('display', 'none');
            }
            $('.' + itemClass).each(function() {
                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', baseCheck);
                }
            });
        }

        function deleteCheckedCustomerItem() {
            let arrayCustomerIds = [];
            $('input:checkbox.itemCustomer').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if (sThisVal) {
                    arrayCustomerIds.push(sThisVal);
                }
            });
            if (arrayCustomerIds.length > 0) {
                $.ajax({
                    url: adminPath + '/customer/customer/' + JSON.stringify(arrayCustomerIds),
                    method: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            } else {
                alert('Please choose at least a item.')
            }
        }

    </script>
@endpush
