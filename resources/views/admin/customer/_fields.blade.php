<script>
    function checkAddressItem(baseId, itemClass) {
        var baseCheck = $('#' + baseId).is(":checked");
        $('.' + itemClass).each(function() {
            if (!$(this).is(':disabled')) {
                $(this).prop('checked', baseCheck);
            }
        });
    }

    function deleteCheckedAddressItem() {
        let arrayMediaIds = [];
        $('input:checkbox.itemAddress').each(function () {
            var sThisVal = (this.checked ? $(this).val() : "");
            if (sThisVal) {
                arrayMediaIds.push(sThisVal);
            }
        });
        if (arrayMediaIds.length > 0) {
            $.ajax({
                url: adminPath + '/customer/customer/' + JSON.stringify(arrayMediaIds),
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

<ul class="nav nav-tabs scrollable">
    <li class="nav-item">
        <a class="nav-link active save-tab" data-toggle="pill" href="#customerItem">
            {{ __('customer::customer.tabs.information') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link save-tab navAddress" data-toggle="pill" href="#customerAddress">
            {{ __('customer::customer.tabs.address') }}
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="customerItem">
        <div class="row">
            <div class="col-12 col-md-6">
                @select(['name' => 'group_id', 'allowClear' => true, 'label' => __('customer::customer.group'), 'options' => get_customer_group_options()])
                @input(['name' => 'firstname', 'label' => __('customer::customer.first_name')])
                @input(['name' => 'lastname', 'label' => __('customer::customer.last_name')])
                @input(['name' => 'email', 'label' => __('customer::customer.email')])
                @input(['name' => 'phone', 'label' => __('customer::customer.phone')])
                @checkbox(['name' => 'is_active', 'label' => '', 'placeholder' => __('customer::customer.is_active'), 'default' => true])
            </div>
            <div class="col-12 col-md-6">
{{--                @mediafile(['name' => 'avatar', 'label' => __('customer::customer.avatar')])--}}
                @select(['name' => 'gender', 'allowClear' => false, 'label' => __('customer::customer.gender.label'), 'options' => [
                    ['value' => '1', 'label' => __('customer::customer.gender.male')],
                    ['value' => '0', 'label' => __('customer::customer.gender.female')],
                ]])
                @input(['name' => 'password', 'label' => __('customer::customer.password'), 'type' => 'password'])
                @input(['name' => 'password_confirmation', 'label' => __('customer::customer.password_confirmation'), 'type' => 'password'])

                @attributes(['entityType' => \Module\Customer\Models\Customer::class])
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="customerAddress">
        @if ($item != null)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('customer::address.firstname') }}</th>
                <th>{{ __('customer::address.lastname') }}</th>
                <th>{{ __('customer::address.phone') }}</th>
                <th>{{ __('customer::address.email') }}</th>
                <th>{{ __('customer::address.province') }}</th>
                <th>{{ __('customer::address.district') }}</th>
                <th>{{ __('customer::address.township') }}</th>
                <th>{{ __('customer::address.street') }}</th>
                <th style="text-align: right;">
                    <a href="#" data-toggle="modal" data-target="#deleteAddress" class="btn btn-danger btn-sm mr-1">
                        Delete
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($item->addresses()->get() as $address)
            <tr>
                <td>
                    <a href="{{ route('customer.admin.address.edit', $address->id) }}">{{ $address->id }}</a>
                </td>
                <td>{{ $address->firstname }}</td>
                <td>{{ $address->lastname }}</td>
                <td>{{ $address->phone }}</td>
                <td>{{ $address->email }}</td>
                <td>{{ object_get($address, 'province.name') }}</td>
                <td>{{ object_get($address, 'district.name') }}</td>
                <td>{{ object_get($address, 'township.name') }}</td>
                <td>{{ $address->street }}</td>
                <td class="text-right">
                    @admincan('customer.admin.customer.edit')
                    <a href="{{ route('customer.admin.address.edit', $address->id) }}" class="btn btn-success-soft btn-sm mr-1">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    @endadmincan

                    @admincan('customer.admin.customer.destroy')
                    <table-button-delete url-delete="{{ route('customer.admin.address.destroy', $address->id) }}"></table-button-delete>
                    @endadmincan
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
        <a href="#" data-toggle="modal" data-target="#addAddress" class="btn btn-secondary btn-sm mr-1">
            <i class="fa fa-plus"></i>
            {{ __('customer::customer.add_address') }}
        </a>
    </div>
</div>

@include('customer::admin.customer.modals.address')
@include('customer::admin.customer.modals.delete')

