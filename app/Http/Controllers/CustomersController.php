<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomersStoreRequest;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customers::all();

        return view('customers.index', compact('customers'));
    }

    /**
     * @param \App\Http\Requests\CustomersStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customers::create($request->validated());

        return redirect()->route('customers.index');
    }
}
