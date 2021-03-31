<?php

namespace App\Http\Controllers;

use App\User;
use App\Dealer;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dealers = Dealer::all();
        return view('pages.dealer.index', ['dealers' => $dealers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sdsms = User::select('id', 'name')->whereHas('designation', function ($q) {
            $q->where('short_name', '=', 'SDSM');
        })->get();


        return view('pages.dealer.create', ['sdsms' => $sdsms]);
    }

    public function search_dsm($id)
    {
        $dsms = User::select('id', 'name')->where('parent_id', $id)->get();
        return response()->json(['dsms' => $dsms], 200);
    }


    public function search_sr($id)
    {
        $srs = User::select('id', 'name')->where('parent_id', $id)->get();
        return response()->json(['srs' => $srs], 200);
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
            'company_name' => 'required'
        ], [
            'company_name.required' => 'Company name is required.',
        ]);

        $dealer = new Dealer();

        if ($request->has('sdsm')) {
            $dealer->sdsm_id = $request->input('sdsm');
        }

        if ($request->has('dsm')) {
            $dealer->dsm_id = $request->input('dsm');
        }

        if ($request->has('sr')) {
            $dealer->sr_id = $request->input('sr');
        }

        if ($request->has('company_name')) {
            $dealer->company_name = $request->input('company_name');
        }

        if ($request->has('dealer_name')) {
            $dealer->dealer_name = $request->input('dealer_name');
        }

        if ($request->has('dealer_code')) {
            $dealer->dealer_code = $request->input('dealer_code');
        }

        if ($request->has('address')) {
            $dealer->address = $request->input('address');
        }

        if ($request->has('phone')) {
            $dealer->phone = $request->input('phone');
        }

        $dealer->created_at = date('Y-m-d');

        $saveDealer = $dealer->save();

        if ($saveDealer) {
            Toastr::success('Dealer has saved.', 'success');
            return redirect()->route('dealer.index');
        } else {
            Toastr::error('W00ps! Something went wrong. Try again.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealer = Dealer::with('sr', 'dsm', 'sdsm')->findOrFail($id);
        return view('pages.dealer.show', ['dealer' => $dealer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sdsms = User::select('id', 'name')->whereHas('designation', function ($q) {
            $q->where('short_name', '=', 'SDSM');
        })->get();

        $dealer = Dealer::with('sr', 'dsm', 'sdsm')->findOrFail($id);

        return view('pages.dealer.edit', ['dealer' => $dealer, 'sdsms' => $sdsms]);
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
        $dealer = Dealer::with('sr', 'dsm', 'sdsm')->findOrFail($id);

        $this->validate($request, [
            'company_name' => 'required'
        ], [
            'company_name.required' => 'Company name is required.',
        ]);

        if ($request->has('sdsm')) {
            $dealer->sdsm_id = $request->input('sdsm');
        }

        if ($request->has('dsm')) {
            $dealer->dsm_id = $request->input('dsm');
        }

        if ($request->has('sr')) {
            $dealer->sr_id = $request->input('sr');
        }

        if ($request->has('company_name')) {
            $dealer->company_name = $request->input('company_name');
        }

        if ($request->has('dealer_name')) {
            $dealer->dealer_name = $request->input('dealer_name');
        }

        if ($request->has('dealer_code')) {
            $dealer->dealer_code = $request->input('dealer_code');
        }

        if ($request->has('address')) {
            $dealer->address = $request->input('address');
        }

        if ($request->has('phone')) {
            $dealer->phone = $request->input('phone');
        }

        $dealer->updated_at = date('Y-m-d');

        $updateDealer = $dealer->save();

        if ($updateDealer) {
            Toastr::success('Dealer info has updated.', 'success');
            return redirect()->route('dealer.index');
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
        //
    }
}
