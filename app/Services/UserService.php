<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Yajra\DataTables\Facades\DataTables;

class UserService {

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getDataTable($request)
    {
        $users = Admin::select('*');
        return DataTables::eloquent($users)
        ->addColumn('action', function($users){
            $getHtml = '<button class="btn user" data-id="'.$users->id.'">';
            $getHtml .= '<i class="fas fa-edit"></i>';
            $getHtml .= '</button>';
            $getHtml .= '<button class="btn removeUser" data-id="'.$users->id.'">';
            $getHtml .= '<i class="fa fa-trash"></i>';
            $getHtml .= '</button>';
            return $getHtml;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
}
