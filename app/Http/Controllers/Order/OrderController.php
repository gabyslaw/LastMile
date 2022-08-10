<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderService $order) {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->order->index();
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
        $save = $this->order->store($request);
        if(!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Could not create Order',
                'data' => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $save
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
        $order = $this->order->findById($id);
        if(!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data'  => $order
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
       $orderUpdate =   $this->order->updateData($request, $id);
        if(!$orderUpdate) {
            return response()->json([
                'status' => false,
                'message' => 'Could not update record',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Order record updated',
            'data'  => $orderUpdate
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
        $order = $this->order->deleteData($id);
        if(!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Order deleted',
            'data'  => []
        ], 200);
    }
}
