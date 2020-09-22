<?php

namespace Modules\Customer;

use Dnsoft\Acl\Facades\Permission;
use Dnsoft\Core\Events\CoreAdminMenuRegistered;
use Dnsoft\Core\Support\BaseModuleServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Customer\Models\Customer;
use Modules\Customer\Models\CustomerAddress;
use Modules\Customer\Models\CustomerGroup;
use Modules\Customer\Repositories\CustomerGroupRepositoryInterface;
use Modules\Customer\Repositories\CustomerRepositoryInterface;
use Modules\Customer\Repositories\Eloquents\CustomerAddressRepository;
use Modules\Customer\Repositories\Eloquents\CustomerGroupRepository;
use Modules\Customer\Repositories\Eloquents\CustomerRepository;
use Modules\Customer\Repositories\CustomerAddressRepositoryInterface;

class CustomerServiceProvider extends BaseModuleServiceProvider
{
    public function getModuleNamespace()
    {
        return 'customer';
    }

    public function boot()
    {
        parent::boot();

        $this->app->singleton(CustomerRepositoryInterface::class, function () {
            return new CustomerRepository(new Customer());
        });

        $this->app->singleton(CustomerAddressRepositoryInterface::class, function () {
            return new CustomerAddressRepository(new CustomerAddress());
        });

        $this->app->singleton(CustomerGroupRepositoryInterface::class, function () {
            return new CustomerGroupRepository(new CustomerGroup());
        });

        $this->registerPermissions();

        $this->registerAdminMenu();
    }

    protected function registerPermissions()
    {
        Permission::add('customer.index', __('customer::permission.customer.index'));
        Permission::add('customer.create', __('customer::permission.customer.create'));
        Permission::add('customer.edit', __('customer::permission.customer.edit'));
        Permission::add('customer.destroy', __('customer::permission.customer.destroy'));
    }

    public function registerAdminMenu()
    {
        Event::listen(CoreAdminMenuRegistered::class, function ($menu) {
            $menu->add('Customer',    ['url'  => 'page.about', 'id' => 'customer']);
            $menu->add('Customer Group', ['url' => 'Link address', 'parent' => $menu->customer->id]);
        });
    }
}
