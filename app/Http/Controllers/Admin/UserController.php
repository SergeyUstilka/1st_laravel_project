<?php

namespace App\Http\Controllers\Admin;

use App\Models\Entrust\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(20);
        return view('admin.user.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $roles = Role::all();
        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_id = $request->role_id;
        $role = Role::query()->where('id', $role_id)->first();
        $user = new User($request->except('_token'));
        $user->password = bcrypt($request->password);
        $user->save();
        $user->attachRole($role);
        return redirect(route('admin.user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Hash::needsRehash($request->password))
        {
            $hashed = Hash::make($request->password);
        }else{
            $hashed = $request->password;
        }

        $role_id = $request->role_id;
        $role = Role::query()->where('id', $role_id)->first();

        $user->name= $request->name;
        $user->password= $hashed;
        $user->email=$request->email;
        $user->save();
        $user->detachRoles($user->roles);
        $user->attachRole($role);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
