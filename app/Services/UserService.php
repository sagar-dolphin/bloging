<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Datatables;

class UserService {

    protected $request;

    public function __construct(UserPostRequest $request)
    {
        $this->request = $request;
    }

    public function getAllUsers($request)
    {
        return datatables()->of(User::all())
        ->addColumn('action', '<button class="btn" ><i class="fas fa-edit"></i></button><button class="btn"><i class="fa fa-trash"></i></button>')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
}
