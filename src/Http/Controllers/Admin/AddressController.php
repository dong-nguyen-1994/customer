<?php

namespace Modules\Customer\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Customer\Http\Requests\AddressRequest;
use Modules\Customer\Models\Address;
use Modules\Customer\Repositories\AddressRepositoryInterface;

class AddressController extends Controller
{
    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function index(Request $request)
    {
        $items = $this->addressRepository->paginate($request->input('max', 20));

        return view('customer::admin.address.index', compact('items'));
    }

    public function create()
    {
        return view('customer::admin.address.create');
    }

    public function store(AddressRequest $request)
    {
        if ($request->ajax()) {
            $data = [
                'customer_id' => $request->customer_id,
                'zone_level_1' => $request->zone_level_1,
                'zone_level_2' => $request->zone_level_2,
                'zone_level_3' => $request->zone_level_3,
                'street' => $request->street_address,
                'firstname' => $request->firstname_address,
                'lastname' => $request->lastname_address,
                'email' => $request->email_address,
                'phone' => $request->phone_address,
            ];
            $item = $this->addressRepository->create($data);
            return response()->json(['success' => true]);
        }
        $item = $this->addressRepository->create($request->all());

        if ($request->input('continue')) {
            return redirect()
                ->route('customer.admin.address.edit', $item->id)
                ->with('success', __('customer::address.notification.created'));
        }

        return redirect()
            ->route('customer.admin.address.index')
            ->with('success', __('customer::address.notification.created'));
    }

    public function edit(Address $item)
    {
        return view('customer::admin.address.edit', compact('item'));
    }

    public function update(AddressRequest $request, $id)
    {
        $item = $this->addressRepository->updateById($request->all(), $id);

        if ($request->input('continue')) {
            return redirect()
                ->route('customer.admin.address.edit', $item->id)
                ->with('success', __('customer::address.notification.updated'));
        }

        return redirect()
            ->route('customer.admin.customer.edit', $item->customer_id)
            ->with('success', __('customer::address.notification.updated'));
    }

    public function destroy($id, Request $request)
    {
        $this->addressRepository->delete($id);

        if ($request->wantsJson()) {
            Session::flash('success', __('customer::address.notification.deleted'));
            return response()->json([
                'success' => true,
            ]);
        }

        return redirect()
            ->route('customer.admin.address.index')
            ->with('success', __('customer::address.notification.deleted'));
    }
}
