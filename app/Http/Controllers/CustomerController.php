<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\NewCustomerModel;
use App\Models\StoreModel;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = CustomerModel::orderBy('ID')->paginate(25);
        return view("customers.index",compact('customers'))-> render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stores = StoreModel::all();
        return view('customers.create' , compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new NewCustomerModel();
        $customer->store_id = $request->store;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->address_id = $request->address_id;
        $customer->active = $request->active;

        $customer->save();
        return redirect('/customer');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = CustomerModel::find($id);
        return view('customers.show', compact('customer'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = NewCustomerModel::find($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customer = NewCustomerModel::find($request->customer_id);


        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->address_id = $request->address_id;

        $customer->save();
        return redirect('/customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = NewCustomerModel::find($id);

        $customer->destroy($id);
        return redirect('/customer');
    }
}
