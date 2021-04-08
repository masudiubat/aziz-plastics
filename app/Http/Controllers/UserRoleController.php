<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('roles', 'designation')->get();
        $roles = Role::all();
        $usersWithoutAnyRoles = User::doesntHave('roles')->get();

        return view('pages.role.index', ['users' => $users, 'roles' => $roles, 'usersWithoutAnyRoles' => $usersWithoutAnyRoles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user' => 'required',
            'role' => 'required'
        ], [
            'user.required' => 'Select an user name first.',
            'user.required' => 'Select a role first.',
        ]);

        if ($request->has('user')) {
            $userId = $request->input('user');
            $user = User::where('id', $userId)->first();
        }

        if ($request->has('role')) {
            $roleId = $request->input('role');
            $role = Role::where('id', $roleId)->first();
        }

        $assignRole = $user->assignRole($role);
        if ($assignRole) {
            Toastr::success('Role is assigned to user.', 'success');
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
