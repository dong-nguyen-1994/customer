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
                <h4 class="page-title">{{ __('customer::customer.index.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a href="{{ route('customer.admin.customer.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> New Customers</a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('customer::customer.name') }}</th>
                                    <th>{{ __('customer::customer.phone') }} / {{ __('customer::customer.email') }}</th>
                                    <th>{{ __('customer::customer.created_at') }}</th>
                                    <th></th>
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
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('customer.admin.customer.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                            <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -6px; margin-top: 4px"></i>
                                        </a>
                                        <button-delete url-delete="{{ route('customer.admin.customer.destroy', $item->id) }}"></button-delete>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pagination-rounded justify-content-end mb-2">
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i class="mdi mdi-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i class="mdi mdi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
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
