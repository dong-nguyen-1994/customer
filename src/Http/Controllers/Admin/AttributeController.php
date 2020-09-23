<?php

namespace Modules\Customer\Http\Controllers\Admin;

use Modules\Customer\Models\Customer;
use Newnet\Eav\Support\Http\Controllers\AttributeController as BaseAttributeController;

class AttributeController extends BaseAttributeController
{
    public function getAdminMenuId()
    {
        return 'customer_attribute';
    }

    public function getEntityType()
    {
        return Customer::class;
    }

    public function getRouteNamePrefix()
    {
        return 'customer.admin.attribute.';
    }
}
