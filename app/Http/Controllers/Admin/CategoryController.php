<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\CategoryPostRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryService $categoryService, Request $request)
    {
        if($request->ajax()){
            return $categoryService->getDataTable($request);
        }
        return view('admin.categories.index');
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
    public function store(CategoryPostRequest $request)
    {
        if($request->ajax() && $request->validated()){
            try {
                $attributes = $request->validated();
                $category = Category::create($attributes);

                return response()->json([
                    'success' => true,
                    'title' => 'Category',
                    'message' => 'successfully added!'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'title' => 'Category',
                    'message' => 'something went wrong',
                ], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::find($id);
            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Category',
                'message' => 'something went wrong!',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryPostRequest $request, Category $category)
    {
        if($request->ajax()){
            try {
                $category = Category::find($request->cat_id);
                $category->update($request->all());
                return response()->json([
                    'success' => true,
                    'title' => 'category',
                    'message' => 'successfully updated!',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'title' => 'category',
                    'message' => 'something went wrong!',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->ajax()){
            try {
                $category = Category::find($id);
                $category->delete();
                return response()->json([
                    'success' => true,
                    'title' => 'Category',
                    'message' => 'successfully deleted!',
                ]);
            } catch (\Exception $th) {
                return response()->json([
                    'success' => false,
                    'title' => 'Category',
                    'message' => 'failed to delete!',
                ]);
            }
        }
    }
}
