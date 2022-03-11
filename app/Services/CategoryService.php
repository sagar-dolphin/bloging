<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryService {

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getDataTable($request)
    {
        $categories = Category::select('*');
        return DataTables::eloquent($categories)
        ->addColumn('action', function($categories){
            $getHtml = '<button class="btn edit-category" data-cat_id="'.$categories->id.'">';
            $getHtml .= '<i class="fas fa-edit"></i>';
            $getHtml .= '</button>';
            $getHtml .= '<button class="btn removeCategory" data-cat_id="'.$categories->id.'">';
            $getHtml .= '<i class="fa fa-trash"></i>';
            $getHtml .= '</button>';
                return $getHtml;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
}