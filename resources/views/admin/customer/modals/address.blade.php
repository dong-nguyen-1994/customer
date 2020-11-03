<div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 650px">
            <div class="modal-header">
                <h5 class="modal-title"> {{ __('customer::customer.add_address') }} <span class="title"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px">
                    <div class="col-lg-6">
                        <input id="customer_id" type="hidden" value="{{$item ? $item->id : ''}}" name="customer_id">
                        @select(['name' => 'zone_level_1', 'label' => __('customer::address.province'), 'options' => get_zone_provice_options()])
                    </div>
                    <div class="col-lg-6">
                        @select(['name' => 'zone_level_2', 'label' => __('customer::address.district'), 'options' => []])
                    </div>
                    <div class="col-lg-6">
                        @select(['name' => 'zone_level_3', 'label' => __('customer::address.township'), 'options' => []])
                    </div>
                    <div class="col-lg-6">
                        @input(['name' => 'street_address', 'label' => __('customer::customer.street')])
                    </div>
                </div>
                <div class="row" style="margin: 5px">
                    <div class="col-lg-6">
                        @input(['name' => 'firstname_address', 'label' => __('customer::customer.first_name')])
                    </div>
                    <div class="col-lg-6">
                        @input(['name' => 'lastname_address', 'label' => __('customer::customer.last_name')])
                    </div>
                    <div class="col-lg-6">
                        @input(['name' => 'email_address', 'label' => __('customer::customer.email')])
                    </div>
                    <div class="col-lg-6">
                        @input(['name' => 'phone_address', 'label' => __('customer::customer.phone')])
                    </div>
                </div>
                <div class="row" style="margin: 5px">

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="" id="categoryId">
                <button type="submit" class="btn btn-success updateOrAddAddress">Save Address</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
