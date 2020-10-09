<?php

use Module\Customer\Http\Controllers\Admin\CustomerController;
use Module\Customer\Http\Controllers\Admin\AddressController;
use Module\Customer\Http\Controllers\Admin\GroupController;
use Module\Customer\Http\Controllers\Admin\AttributeController;

Route::prefix('customer')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::get('', [CustomerController::class, 'index'])
            ->name('customer.admin.customer.index')
            ->middleware('admin.can:customer.admin.customer.index');

        Route::get('create', [CustomerController::class, 'create'])
            ->name('customer.admin.customer.create')
            ->middleware('admin.can:customer.admin.customer.create');

        Route::post('/', [CustomerController::class, 'store'])
            ->name('customer.admin.customer.store')
            ->middleware('admin.can:customer.admin.customer.create');

        Route::get('{id}/edit', [CustomerController::class, 'edit'])
            ->name('customer.admin.customer.edit')
            ->middleware('admin.can:customer.admin.customer.edit');

        Route::put('{id}', [CustomerController::class, 'update'])
            ->name('customer.admin.customer.update')
            ->middleware('admin.can:customer.admin.customer.edit');

        Route::delete('{id}', [CustomerController::class, 'destroy'])
            ->name('customer.admin.customer.destroy')
            ->middleware('admin.can:customer.admin.customer.destroy');
    });

    Route::prefix('address')->group(function () {
        Route::get('', [AddressController::class, 'index'])
            ->name('customer.admin.address.index')
            ->middleware('admin.can:customer.admin.address.index');

        Route::get('create', [AddressController::class, 'create'])
            ->name('customer.admin.address.create')
            ->middleware('admin.can:customer.admin.address.create');

        Route::post('/', [AddressController::class, 'store'])
            ->name('customer.admin.address.store')
            ->middleware('admin.can:customer.admin.address.create');

        Route::get('{item}/edit', [AddressController::class, 'edit'])
            ->name('customer.admin.address.edit')
            ->middleware('admin.can:customer.admin.address.edit');

        Route::put('{id}', [AddressController::class, 'update'])
            ->name('customer.admin.address.update')
            ->middleware('admin.can:customer.admin.address.edit');

        Route::delete('{id}', [AddressController::class, 'destroy'])
            ->name('customer.admin.address.destroy')
            ->middleware('admin.can:customer.admin.address.destroy');
    });

    Route::prefix('group')->group(function () {
        Route::get('', [GroupController::class, 'index'])
            ->name('customer.admin.group.index')
            ->middleware('admin.can:customer.admin.group.index');

        Route::get('create', [GroupController::class, 'create'])
            ->name('customer.admin.group.create')
            ->middleware('admin.can:customer.admin.group.create');

        Route::post('/', [GroupController::class, 'store'])
            ->name('customer.admin.group.store')
            ->middleware('admin.can:customer.admin.group.create');

        Route::get('{id}/edit', [GroupController::class, 'edit'])
            ->name('customer.admin.group.edit')
            ->middleware('admin.can:customer.admin.group.edit');

        Route::put('{id}', [GroupController::class, 'update'])
            ->name('customer.admin.group.update')
            ->middleware('admin.can:customer.admin.group.edit');

        Route::delete('{id}', [GroupController::class, 'destroy'])
            ->name('customer.admin.group.destroy')
            ->middleware('admin.can:customer.admin.group.destroy');
    });

    Route::prefix('attribute')->group(function () {
        Route::get('', [AttributeController::class, 'index'])
            ->name('customer.admin.attribute.index')
            ->middleware('admin.can:customer.admin.attribute.index');

        Route::get('create', [AttributeController::class, 'create'])
            ->name('customer.admin.attribute.create')
            ->middleware('admin.can:customer.admin.attribute.create');

        Route::post('/', [AttributeController::class, 'store'])
            ->name('customer.admin.attribute.store')
            ->middleware('admin.can:customer.admin.attribute.create');

        Route::get('{id}/edit', [AttributeController::class, 'edit'])
            ->name('customer.admin.attribute.edit')
            ->middleware('admin.can:customer.admin.attribute.edit');

        Route::put('{id}', [AttributeController::class, 'update'])
            ->name('customer.admin.attribute.update')
            ->middleware('admin.can:customer.admin.attribute.edit');

        Route::delete('{id}', [AttributeController::class, 'destroy'])
            ->name('customer.admin.attribute.destroy')
            ->middleware('admin.can:customer.admin.attribute.destroy');
    });
});
