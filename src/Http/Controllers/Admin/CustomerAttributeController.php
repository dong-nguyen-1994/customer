<?php

namespace Module\Customer\Http\Controllers\Admin;

use Dnsoft\Eav\Http\Controllers\Admin\AttributeController as BaseAttributeController;
use Module\Customer\Models\Customer;

class CustomerAttributeController extends BaseAttributeController
{
    public function getAdminMenuId(): string
    {
        return 'customerAttribute';
    }

    public function getEntityType(): string
    {
        return Customer::class;
    }

    public function getNamePrefixRoute(): string
    {
        return 'customer.admin.customer-attribute.';
    }
}
