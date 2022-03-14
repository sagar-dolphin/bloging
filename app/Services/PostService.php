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
        ->addColumn('image', function ($posts) { 
            $url= asset('images/'.$posts->image);
            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->addColumn('action', function($posts){
            $getHtml = '<button class="btn btn-edit" data-toggle="modal" data-target="#editPostModal" data-post_id="'.$posts->id.'">';
            $getHtml .= '<i class="fas fa-edit"></i>';
            $getHtml .= '</button>';
            $getHtml .= '<button class="btn btn-delete" data-post_id="'.$posts->id.'">';
            $getHtml .= '<i class="fa fa-trash"></i>';
            $getHtml .= '</button>';
            if(auth()->user()->hasRole('editor')){
                return $getHtml;
            }
        })
        ->rawColumns(['image', 'action'])
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