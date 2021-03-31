<?php

namespace App\Http\Controllers;

use App\User;
use App\Designation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('designation')->get();
        $designations = Designation::all();
        return view('pages.user.index', ['users' => $users, 'designations' => $designations]);
    }

    public function search_supervisor($id)
    {
        $designation = Designation::select('order_id')->findOrFail($id);

        // get previous user id
        $previousDesignation = Designation::select('id', 'order_id')->where('order_id', '<', $designation->order_id)->where('order_id', '>', 0)->get();

        $supervisorList = array();
        $i = 0;
        foreach ($previousDesignation as $designation) {
            $supervisors = User::select('id', 'name')->where('designation_id', $designation->id)->get();
            foreach ($supervisors as $supervisor) {
                $supervisorList[$i]['id'] = $supervisor->id;
                $supervisorList[$i++]['name'] = $supervisor->name;
            }
        }
        return response()->json(['supervisorList' => $supervisorList], 200);
    }

    public function create_userid($id)
    {

        $explodeValue = explode(",", $id);
        $designation = $explodeValue[0];
        $supervisor = $explodeValue[1];

        $user = User::select('id', 'user_id')
            ->where('designation_id', '=', $designation)
            ->where('parent_id', '=', $supervisor)
            ->orderBy('id', 'DESC')
            ->first();
        $supervisorUser = User::select('id', 'user_id')->where('id', '=', $supervisor)->first();

        if ($user) {
            $userId = $user->user_id + 1;
        } else {
            $userId = $supervisorUser->user_id + '101';
        }

        return response()->json(['userId' => $userId], 200);
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
            'user_id' => 'required | unique:users',
            'name' => 'required | string | max:255',
            'email' => 'required | string | email | max:255 | unique:users',
            'phone' => 'required | unique:users',
            'password' => 'required | string | min:8 | confirmed',
        ]);

        $user = new User();

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }

        if ($request->has('designation')) {
            $user->designation_id = $request->input('designation');
        }

        if ($request->has('supervisor')) {
            $user->parent_id = $request->input('supervisor');
        }

        if ($request->has('user_id')) {
            $user->user_id = $request->input('user_id');
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->created_at = date('Y-m-d');

        $createUser = $user->save();

        if ($createUser) {
            Toastr::success('New user has created successfully.', 'success');
            return redirect()->back();
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
        $user = User::with('designation')->findOrFail($id);
        $designations = Designation::all();

        $designationOrderId = Designation::select('order_id')->where('id', $user->designation_id)->first();

        // get previous user id
        $previousDesignation = Designation::select('id', 'order_id')->where('order_id', '<', $designationOrderId->order_id)->where('order_id', '>', 0)->get();

        $supervisorList = array();
        $i = 0;
        foreach ($previousDesignation as $designation) {
            $supervisors = User::select('id', 'name')->where('designation_id', $designation->id)->get();
            foreach ($supervisors as $supervisor) {
                $supervisorList[$i]['id'] = $supervisor->id;
                $supervisorList[$i++]['name'] = $supervisor->name;
            }
        }

        return response()->json(['user' => $user, 'designations' => $designations, 'supervisorList' => $supervisorList], 200);
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'user_id' => 'required | unique:users,user_id,' . $user->id,
            'name' => 'required | string | max:255',
            'email' => 'required | string | email | max:255 | unique:users,email,' . $user->id,
            'phone' => 'required | unique:users,phone,' . $user->id,
        ]);

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }

        if ($request->has('designation')) {
            $user->designation_id = $request->input('designation');
        }

        if ($request->has('supervisor')) {
            $user->parent_id = $request->input('supervisor');
        }

        if ($request->has('user_id')) {
            $user->user_id = $request->input('user_id');
        }

        $user->updated_at = date('Y-m-d');

        $userUser = $user->save();

        if ($userUser) {
            Toastr::success('User info has updated successfully.', 'success');
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
        //
    }
}
