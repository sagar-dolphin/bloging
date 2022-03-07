<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *s
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        if($request->ajax()){
            try {
                $roles = Role::select('*');
                return DataTables::eloquent($roles)
                ->addColumn('action', function($roles){
                    // $getHtml = '<button class="btn edit-role" data-role_id="'.$roles->id.'">';
                    // $getHtml .= '<i class="fas fa-edit"></i>';
                    // $getHtml .= '</button>';
                    // $getHtml .= '<button class="btn removeRole" data-role_id="'.$roles->id.'">';
                    // $getHtml .= '<i class="fa fa-trash"></i>';
                    // $getHtml .= '</button>';
                    // return $getHtml;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            } catch (\Exception $th) {
                return response()->json([
                    'success' => true,
                    'title' => 'roles',
                    'message' => 'Something went wrong!',
                ]);
            }
        }
        return view('admin.roles.index');
    }

    public function getRoles(Request $request)
    {
        if($request->ajax()){
            try {
                $roles = Role::all();
                return response()->json($roles);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'title' => 'role',
                    'message' => 'roles not found',
                ]);
            }
        }
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
    public function store(RoleRequest $request)
    {
        if($request->ajax()){
            try {
                $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
                return response()->json([
                    'success' => true,
                    'title' => 'role',
                    'message' => 'Role successfully added!',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'title' => 'role',
                    'message' => 'Somethig went wrong!',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
