<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\DataTables\RoleDataTable $table
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $table)
    {
        return $table->render('pages.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $allPermissions = Permission::all();
        $inPermissions = [];

        return view('pages.roles.create', compact('allPermissions', 'role', 'inPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::create($data);

        $this->syncPermissions($role, $request);

        // TODO: Flash message
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->edit($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $allPermissions = Permission::all();
        $inPermissions = $role->getPermissionNames()->toArray();

        return view('pages.roles.update', compact('allPermissions', 'role', 'inPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $role->fill($data)->saveOrFail();

        $this->syncPermissions($role, $request);

        // TODO: Flash message

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // TODO: Don't allow delete assigned role
        if (false) {
            $role->delete();
            // TODO: Flash message
        } else {
            // TODO: Flash message
        }

        return redirect()->route('roles.index');
    }

    /**
     * Sync permissions to role
     *
     * @param \App\Models\Role $role
     * @param \Illuminate\Http\Request $request
     */
    protected function syncPermissions(Role $role, Request $request)
    {
        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions'));
        }
    }
}
