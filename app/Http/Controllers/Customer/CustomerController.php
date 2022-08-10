<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(CustomerService $customer) {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->customer->index();
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = $this->customer->store($request);
        if(!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Could not create customer',
                'data' => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $customer
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customer->findById($id);
        if(!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data'  => $customer
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $customerUpdate =   $this->customer->updateData($request, $id);
        if(!$customerUpdate) {
            return response()->json([
                'status' => false,
                'message' => 'Could not update record',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Customer record updated',
            'data'  => $customerUpdate
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->customer->deleteData($id);
        if(!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Customer deleted',
            'data'  => []
        ], 200);
    }
}
