<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\DataTables\UserDataTable $table
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $table)
    {
        return $table->render('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all();
        $inRoles = [];
        return view('pages.users.create', compact(['user', 'roles', 'inRoles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);
        $role = $request->validate([
            'role' => 'required'
        ]);
        if ($role['role'] != 'Administrators') {
            $magv = $request->validate([
                'magv' => 'required'
            ]);
            $data['password'] = Hash::make('a12345678X');
            $user = User::create($data);
            $user->assignRole($role['role']);
            Teacher::create([
                'userId' => $user->id,
                'name' => $user->name,
                'magv' => $magv['magv'],
            ]);
        } else {
            $data['password'] = Hash::make('a12345678X');
            $user = User::create($data);
            $user->assignRole($role['role']);
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $allPermissions = Permission::all();
        $inPermissions = $user->getPermissionNames()->toArray();
        return view('pages.users.update', compact('user', 'allPermissions', 'inPermissions', 'id'));
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
        $data = $request->validate([
           'name' => 'required|max:255',
           'email' => 'required|email',
        ]);
        $permiss = $request->validate([
            'permissions' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->update($data);
        $user->syncPermissions($permiss['permissions']);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
