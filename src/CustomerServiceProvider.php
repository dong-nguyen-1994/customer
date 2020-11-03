<?php

namespace Module\Customer;

use Dnsoft\Core\Events\CoreAdminMenuRegistered;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Module\Customer\Events\CustomerAdminMenuRegistered;
use Module\Customer\Http\Middleware\Authenticate;
use Module\Customer\Http\Middleware\RedirectIfAuthenticated;
use Module\Customer\Models\Address;
use Module\Customer\Models\Group;
use Module\Customer\Repositories\CustomerAddressRepositoryInterface;
use Module\Customer\Repositories\Eloquents\CustomerAddressRepository;
use Module\Customer\Repositories\Eloquents\CustomerGroupRepository;
use Module\Customer\Repositories\GroupRepositoryInterface;
use Dnsoft\Acl\Facades\Permission;
use Dnsoft\Core\Support\BaseModuleServiceProvider;
use Module\Customer\Repositories\Eloquents\CustomerRepository;
use Module\Customer\Repositories\CustomerRepositoryInterface;
use Module\Customer\Models\Customer;

class CustomerServiceProvider extends BaseModuleServiceProvider
{
    public function getModuleNamespace()
    {
        return 'customer';
    }

    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(__DIR__.'/../config/customer.php', 'customer');

        $this->registerConfigData();

        $this->registerMiddleware();

        $this->app->singleton(CustomerRepositoryInterface::class, function () {
            return new CustomerRepository(new Customer());
        });

        $this->app->singleton(CustomerAddressRepositoryInterface::class, function () {
            return new CustomerAddressRepository(new Address());
        });

        $this->app->singleton(GroupRepositoryInterface::class, function () {
            return new CustomerGroupRepository(new Group());
        });

        require_once __DIR__.'/../helpers/helpers.php';

    }

    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__.'/../config/customer.php' => config_path('customer.php'),
        ], 'module-config');

        $this->publishes([
            __DIR__ . '/../public/customer' => public_path('vendor/customer'),
        ], 'customer');

        $this->registerAdminMenus();

//        eav_entity()->push(Customer::class);
    }

    protected function registerConfigData()
    {
        $aclConfigData = include __DIR__ . '/../config/customer.php';
        $authConfig = $this->app['config']->get('auth');
        $auth = array_merge_recursive_distinct($aclConfigData['auth'], $authConfig);
        $this->app['config']->set('auth', $auth);
    }

    protected function registerMiddleware()
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('auth', Authenticate::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);
    }

    public function registerPermissions()
    {
        Permission::add('customer.admin.customer.index', __('customer::permission.customer.index'));
        Permission::add('customer.admin.customer.create', __('customer::permission.customer.create'));
        Permission::add('customer.admin.customer.edit', __('customer::permission.customer.edit'));
        Permission::add('customer.admin.customer.destroy', __('customer::permission.customer.destroy'));

        Permission::add('customer.admin.address.index', __('customer::permission.address.index'));
        Permission::add('customer.admin.address.create', __('customer::permission.address.create'));
        Permission::add('customer.admin.address.edit', __('customer::permission.address.edit'));
        Permission::add('customer.admin.address.destroy', __('customer::permission.address.destroy'));

        Permission::add('customer.admin.group.index', __('customer::permission.group.index'));
        Permission::add('customer.admin.group.create', __('customer::permission.group.create'));
        Permission::add('customer.admin.group.edit', __('customer::permission.group.edit'));
        Permission::add('customer.admin.group.destroy', __('customer::permission.group.destroy'));

        Permission::add('customer.admin.attribute.index', __('customer::permission.attribute.index'));
        Permission::add('customer.admin.attribute.create', __('customer::permission.attribute.create'));
        Permission::add('customer.admin.attribute.edit', __('customer::permission.attribute.edit'));
        Permission::add('customer.admin.attribute.destroy', __('customer::permission.attribute.destroy'));
    }

    public function registerAdminMenus()
    {
        Event::listen(CoreAdminMenuRegistered::class, function ($menu) {

            $menu->add('Customer', ['id' => 'customer'])->data('order', 2000)->prepend('<i class="fas fa-users"></i>');
            $menu->add('Customer', ['route' => 'customer.admin.customer.index', 'parent' => $menu->customer->id])->prepend('<i class="fas fa-user-tie"></i>');
            $menu->add('Customer Group', ['route' => 'customer.admin.group.index', 'parent' => $menu->customer->id])->prepend('<i class="fas fa-object-ungroup"></i>');

            event(CustomerAdminMenuRegistered::class, $menu);
        });

    }
}
