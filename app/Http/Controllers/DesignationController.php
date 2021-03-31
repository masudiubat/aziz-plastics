<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::select('id', 'name', 'short_name', 'order_id')->orderBy('order_id', 'ASC')->get();
        return view('pages.designation.index', ['designations' => $designations]);
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
            'name' => 'required | max:255',
            'short_name' => 'required | max:255'
        ], [
            'name.required' => 'Name is required.',
            'short_name.required' => 'Short name is required.'
        ]);

        $designation = new Designation();

        if ($request->has('name')) {
            $designation->name = $request->input('name');
        }

        if ($request->has('short_name')) {
            $designation->short_name = $request->input('short_name');
        }

        if ($request->filled('order_id')) {
            $designation->order_id = $request->input('order_id');
        } else {
            $designationOrderId = Designation::select('order_id')->orderBy('order_id', 'DESC')->first();
            $designation->order_id = $designationOrderId->order_id + 1;
        }

        $designation->created_at = date('Y-m-d');

        $createDesignation = $designation->save();

        if ($createDesignation) {
            Toastr::success('New designation saved successfully.', 'success');
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
        $designation = Designation::findOrFail($id);
        return response()->json(['designation' => $designation], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $designation = Designation::findOrFail($id);

        $this->validate($request, [
            'name' => 'required | max:255',
            'short_name' => 'required | max:255'
        ], [
            'name.required' => 'Name is required.',
            'short_name.required' => 'Short name is required.'
        ]);

        if ($request->has('name')) {
            $designation->name = $request->input('name');
        }

        if ($request->has('short_name')) {
            $designation->short_name = $request->input('short_name');
        }

        if ($request->filled('order_id')) {
            $designation->order_id = $request->input('order_id');
        } else {
            $designationOrderId = Designation::select('order_id')->orderBy('order_id', 'DESC')->first();
            $designation->order_id = $designationOrderId->order_id + 1;
        }

        $designation->updated_at = date('Y-m-d');

        $updateDesignation = $designation->save();

        if ($updateDesignation) {
            Toastr::success('Designation update successfull.', 'success');
            return redirect()->back();
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
        $designation = Designation::findOrFail($id);
        $deleteDesignation = $designation->delete();
        if ($deleteDesignation) {
            Toastr::success('Designation has deleted successfully.', 'success');
            return redirect()->back();
        } else {
            Toastr::error('W00ps! Something went wrong. Try again.', 'error');
            return redirect()->back();
        }
    }
}
