<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RiderService;

class RiderController extends Controller
{
    protected $rider;

    public function __construct(RiderService $rider) {
        $this->rider = $rider;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->rider->index();
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
        $rider = $this->rider->store($request);
        if(!$rider) {
            return response()->json([
                'status' => false,
                'message' => 'Could not create Rider',
                'data' => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $rider
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
        $rider = $this->rider->findById($id);
        if(!$rider) {
            return response()->json([
                'status' => false,
                'message' => 'Rider not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data'  => $rider
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
       $riderUpdate =   $this->rider->updateData($request, $id);
        if(!$riderUpdate) {
            return response()->json([
                'status' => false,
                'message' => 'Could not update record',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Rider record updated',
            'data'  => $riderUpdate
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
        $rider = $this->rider->deleteData($id);
        if(!$rider) {
            return response()->json([
                'status' => false,
                'message' => 'Rider not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Rider deleted',
            'data'  => []
        ], 200);
    }
}
