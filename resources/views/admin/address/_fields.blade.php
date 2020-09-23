<div class="row">
    <div class="col-md-6">
        @input(['name' => 'firstname', 'label' => __('customer::customer.first_name')])
    </div>
    <div class="col-md-6">
        @input(['name' => 'lastname', 'label' => __('customer::customer.last_name')])
    </div>
    <div class="col-md-6">
        @input(['name' => 'email', 'label' => __('customer::customer.email')])
    </div>
    <div class="col-md-6">
        @input(['name' => 'phone', 'label' => __('customer::customer.phone')])
    </div>
    <div class="col-md-6">
        @select(['name' => 'zone_level_1', 'label' => __('customer::address.province'), 'options' => get_zone_provice_options()])
    </div>
    <div class="col-md-6">
        @select(['name' => 'zone_level_2', 'label' => __('customer::address.district'), 'options' => []])
    </div>
    <div class="col-md-6">
        @select(['name' => 'zone_level_3', 'label' => __('customer::address.township'), 'options' => []])
    </div>
    <div class="col-md-6">
        @input(['name' => 'street', 'label' => __('customer::address.street')])
    </div>
</div>
