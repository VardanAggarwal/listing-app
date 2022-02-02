<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index',['categories'=>Category::with('resiliencies')->orderByDesc('created_at')->get()]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category=Category::create($request->all());
        return redirect('/categories/'.$category->id);
        //return view('categories.category',['category'=>$category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.category',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Auth::user()){
            if(Auth::user()->role_id==1){
                Models\Reliable::where('reliable_type','App\\Models\\Category')->where('reliable_id',$category->id)->delete();
                Models\Interestable::where('interestable_type','App\\Models\\Category')->where('interestable_id',$category->id)->delete();
                Models\Attachable::where('attachable_type','App\\Models\\Category')->where('attachable_id',$category->id)->delete();
                foreach($category->statements as $statement){
                    $statement->stateable()->dissociate();
                }
                $category->delete();
                return redirect('/categories');
            }
        }
    }
}
