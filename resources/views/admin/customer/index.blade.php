@extends('core::admin.master')

@section('meta_title', __('customer::customer.index.page_title'))

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
                <h4 class="page-title">{{ __('customer::customer.create.page_title') }}</h4>
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
                                    <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('customer.admin.customer.create') }}"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a>
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
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('customer::customer.name') }}</th>
                                <th>{{ __('customer::customer.phone') }} / {{ __('customer::customer.email') }}</th>
                                <th>{{ __('customer::customer.is_active') }}</th>
                                <th>{{ __('customer::customer.created_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.admin.customer.edit', $item->id) }}">
                                            {{ $item->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <p class="mb-1">{{ $item->phone }}</p>
                                        <p class="mb-0">{{ $item->email }}</p>
                                    </td>
                                    <td>
                                        @if($item->is_active)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="far fa-times-circle" style="color: red"></i>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-right">

                                        @admincan('customer.admin.customer.edit')
                                        <a href="{{ route('customer.admin.customer.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                            <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                        </a>
                                        @endadmincan

                                        @admincan('customer.admin.customer.destroy')
                                        <button-delete url-delete="{{ route('customer.admin.customer.destroy', $item->id) }}"></button-delete>
                                        @endadmincan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
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
