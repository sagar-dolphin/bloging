<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Post;
use Yajra\DataTables\Facades\DataTables;

class PostService {

    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getDataTable($request)
    {
        $posts = Post::select('*');
        return DataTables::eloquent($posts)
        ->addColumn('action', function($posts){
            $getHtml = '<button class="btn edit-category" data-cat_id="'.$posts->id.'">';
            $getHtml .= '<i class="fas fa-edit"></i>';
            $getHtml .= '</button>';
            $getHtml .= '<button class="btn removeCategory" data-cat_id="'.$posts->id.'">';
            $getHtml .= '<i class="fa fa-trash"></i>';
            $getHtml .= '</button>';
            if(auth()->user()->hasRole('editor')){
                return $getHtml;
            }
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }

    public function handleImage($image)
    {
        if(!is_null($image)){
            $filename = date('YmdHi').$image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            return $filename;
        }
    }
}