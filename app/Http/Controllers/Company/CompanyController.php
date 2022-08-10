<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $company;

    public function __construct(CompanyService $company) {
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->company->index();
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
        $company = $this->company->store($request);
        if(!$company) {
            return response()->json([
                'status' => false,
                'message' => 'Could not create Company',
                'data' => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $company
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
        $company = $this->company->findById($id);
        if(!$company) {
            return response()->json([
                'status' => false,
                'message' => 'Company not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data'  => $company
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
       $companyUpdate =   $this->company->updateData($request, $id);
        if(!$companyUpdate) {
            return response()->json([
                'status' => false,
                'message' => 'Could not update record',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Company record updated',
            'data'  => $companyUpdate
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
        $company = $this->company->deleteData($id);
        if(!$company) {
            return response()->json([
                'status' => false,
                'message' => 'Company not found',
                'data'  => []
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => 'Company deleted',
            'data'  => []
        ], 200);
    }
}
