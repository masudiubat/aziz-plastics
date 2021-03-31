<?php

namespace App\Http\Controllers;

use App\Dealer;
use App\Product;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.do.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companys = Dealer::select('id', 'company_name')->get();
        $models = Product::select('id', 'model')->get();
        return view('pages.do.create', ['models' => $models, 'companys' => $companys]);
    }

    public function search_company_details($id)
    {
        $company = Dealer::select('id', 'company_name', 'dealer_code', 'address', 'phone')->findOrFail($id);
        return response()->json(['company' => $company], 200);
    }

    public function search_product_size($id)
    {
        $model = Product::select('model')->where('id', $id)->first();
        $sizes = Product::select('id', 'model', 'size')->where('model', '=', $model->model)->get();
        return response()->json(['sizes' => $sizes], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
