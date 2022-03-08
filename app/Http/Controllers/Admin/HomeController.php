<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        switch($user->name)
        {
            case 'user':
                $role = Role::where('name', $user->name)->get();
                $permissions = Permission::where('guard_name', $user->name)->get();
                break;
            case 'admin':
                $role = Role::where('name', $user->name)->get();
                $permissions = Permission::where('guard_name', $user->name)->get();
                break;
        }
        // $role->syncPermissions($permissions);
        return view('admin.home');
    }   
}