<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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
        $users = User::select('id','email','name')->with('role')->get()->toarray();
        foreach ($users as $user) {
            $user['role'] = $user['role'][0]['name'];
            $userData[] = $user;
        };
        return $userData;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::select('id','name','email')->where('id',$user_id)->with('role')->first();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $role = Role::where('name', $request->input('role'))->first();
        $user->role()->sync($role);
    }

    public function store(UserRequest $UserRequest){
        User::create(array(
            'name' => $UserRequest->input('name'),
            'email' => $UserRequest->input('email'),
            'password' => Hash::make($UserRequest->input('password'))
        ));
        $user = User::latest()->first();
        $role = Role::where('name',$UserRequest->input('role'))->first();
        $user->role()->sync($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->delete();
        return 'user deleted';
    }

    public function getRoles(){
        $roles = Role::select('name')->get();
        foreach ($roles as $role) {
            $roleData[] = $role['name'];
        }
        return $roleData;
    }
}
