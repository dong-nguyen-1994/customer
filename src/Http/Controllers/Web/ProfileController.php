<?php

namespace Modules\Customer\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Http\Requests\CustomerRequest;
use Modules\Customer\Repositories\CustomerRepositoryInterface;

class ProfileController extends Controller
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->middleware(['auth:customer', 'verified']);

        $this->customerRepository = $customerRepository;
    }

    public function profile()
    {
        return view('customer::web.customer.profile');
    }

    public function update(CustomerRequest $request)
    {
        $this->customerRepository->updateById($request->all(), auth()->user()->id);
        return redirect()
            ->back()->with('success', __('customer::customer.notification.updated'));
    }
}
