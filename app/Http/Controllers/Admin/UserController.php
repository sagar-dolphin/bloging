<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserService $userService, Request $request)
    {
        if($request->ajax()){
            return $userService->getDataTable($request);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        if($request->ajax() && $request->validated()){
            try {
                $attributes = $request->validated();
                $user = User::create($attributes);
                return response()->json([
                    'success' => true,
                    'title' => 'User',
                    'message' => 'User successfully created!'
                ], 200);
            }  catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'title' => 'User',
                    'message' => 'Something went wrong!'
                ], 200);
            }
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
        try {
            $user = User::find($id);
            return response()->json($user);
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'title' => 'Edit User',
                'message' => 'Something problem to edit user!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request)
    {
        if($request->ajax() && $request->validated()){
            try {
                $attributes = $request->all();
                $user = User::find($request->user_id);
                $user->update($attributes);
                return response()->json([
                    'success' => true,
                    'title' => 'User',
                    'message' => 'successfully updated!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'title' => 'User',
                    'message' => 'Something problem to update data!'
                ]);
            }
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
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                'success' => true,
                'title' => 'User',
                'message' => 'successfully deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'User',
                'message' => 'failed to delete user'
            ]);
        }
    }
}
