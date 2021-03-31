<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'model' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Name is required.',
            'category.required' => 'Category is required.',
            'model' => 'Model is required',
            'price' => 'Price is required'
        ]);

        $product = new Product();

        if ($request->has('category')) {
            $product->category = $request->input('category');
        }

        if ($request->has('name')) {
            $product->name = $request->input('name');
        }

        if ($request->has('model')) {
            $product->model = $request->input('model');
        }

        if ($request->has('size')) {
            $product->size = $request->input('size');
        }

        if ($request->has('weight')) {
            $product->weight = $request->input('weight');
        }

        if ($request->has('price')) {
            $product->price = $request->input('price');
        }

        if ($request->has('discount')) {
            $product->discount = $request->input('discount');
        }

        if ($request->has('net_price')) {
            $product->net_price = $request->input('net_price');
        }

        $product->created_at = date('Y-m-d');

        $productCreate = $product->save();

        if ($productCreate) {
            Toastr::success('Product has saved.', 'success');
            return redirect()->back();
        } else {
            Toastr::error('W00ps! Something went wrong. Try again.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product.edit', ['product' => $product]);
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
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'model' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Name is required.',
            'category.required' => 'Category is required.',
            'model' => 'Model is required',
            'price' => 'Price is required'
        ]);

        if ($request->has('category')) {
            $product->category = $request->input('category');
        }

        if ($request->has('name')) {
            $product->name = $request->input('name');
        }

        if ($request->has('model')) {
            $product->model = $request->input('model');
        }

        if ($request->has('size')) {
            $product->size = $request->input('size');
        }

        if ($request->has('weight')) {
            $product->weight = $request->input('weight');
        }

        if ($request->has('price')) {
            $product->price = $request->input('price');
        }

        if ($request->has('discount')) {
            $product->discount = $request->input('discount');
        }

        if ($request->has('net_price')) {
            $product->net_price = $request->input('net_price');
        }

        $product->updated_at = date('Y-m-d');

        $productUpdate = $product->save();

        if ($productUpdate) {
            Toastr::success('Product has updated.', 'success');
            return redirect()->route('product.index');
        } else {
            Toastr::error('W00ps! Something went wrong. Try again.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $deleteProduct = $product->delete();
        if ($deleteProduct) {
            Toastr::success('Product has deleted.', 'success');
            return redirect()->route('product.index');
        } else {
            Toastr::error('W00ps! Something went wrong. Try again.', 'error');
            return redirect()->back();
        }
    }
}
