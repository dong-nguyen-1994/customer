<?php

namespace Modules\Customer;

use Dnsoft\Core\Events\CoreAdminMenuRegistered;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Modules\Customer\Events\CustomerAdminMenuRegistered;
use Modules\Customer\Http\Middleware\Authenticate;
use Modules\Customer\Http\Middleware\RedirectIfAuthenticated;
use Modules\Customer\Models\Address;
use Modules\Customer\Models\Group;
use Modules\Customer\Repositories\CustomerAddressRepositoryInterface;
use Modules\Customer\Repositories\Eloquents\CustomerAddressRepository;
use Modules\Customer\Repositories\Eloquents\CustomerGroupRepository;
use Modules\Customer\Repositories\GroupRepositoryInterface;
use Dnsoft\Acl\Facades\Permission;
use Dnsoft\Core\Support\BaseModuleServiceProvider;
use Modules\Customer\Repositories\Eloquents\CustomerRepository;
use Modules\Customer\Repositories\CustomerRepositoryInterface;
use Modules\Customer\Models\Customer;

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

            $menu->add('Customer', ['id' => 'customer'])->data('order', 2000);
            $menu->add('Customer', ['route' => 'customer.admin.customer.index', 'parent' => $menu->customer->id]);
            $menu->add('Customer Group', ['route' => 'customer.admin.group.index', 'parent' => $menu->customer->id]);

            event(CustomerAdminMenuRegistered::class, $menu);
        });

    }
}
