<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function edit($id)
    {
        $category = Category::findorFail($id);
        return view('admin.category.edit',compact('category'));
    }
    public function store(Request $request){
        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'icon' => 'required',
        ]);
        $category = new Category;
        $category->title = $request->title;
        $category->status = $request->status;
        if($category->save()){
            if($request->has('icon')){
                $photo = 'photo-'.$category->id.'.'.$request->icon->extension();
                $category->addMediaFromRequest('icon')->usingName($photo)->toMediaCollection('service');
            }
            return redirect()->route('admin.services')->with('success', 'service has been created successfully');
        }else{
            return redirect()->route('admin.category.create')->with('error', 'Category not created');
        }
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $category =  Category::findOrFail($request->id);
        $category->title = $request->title;
        $category->status = $request->status;
        if($category->save()){
            return redirect()->route('admin.services')->with('success', 'Category has been updated successfully');
        }else{
            return redirect()-back()->with('error', 'Category not updated');
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $category =  Category::findOrFail($request->id);
        if($category->delete()){
            return response(['success' => true,'message' => 'Category has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'Category not deleted']);

        }
    }
}
