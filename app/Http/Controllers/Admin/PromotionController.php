<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Workshop;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('workshop')->get();
        return view('admin.promotion.index', compact('promotions'));
    }
    public function create()
    {
        $workshops = Workshop::get();
        return view('admin.promotion.create',compact('workshops'));
    }
    public function edit($id)
    {
        $promotion = Promotion::findorFail($id);
        return view('admin.category.edit', compact('promotion'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'workshop' => 'required',
            'icon' => 'required',
        ]);

        $promotion = new Promotion;
        $promotion->status = $request->status;
        $promotion->title = $request->title;
        $promotion->workshop_id = $request->workshop;
        if ($promotion->save()) {
            $photo = 'title-'.$promotion->id.'.'.$request->icon->extension();
            $promotion->addMediaFromRequest('icon')->usingName($photo)->toMediaCollection('promotion');
            return redirect()->route('admin.promotions.index')->with('success', 'Promotion has been created successfully');
        } else {
            return redirect()->route('admin.promotions.create')->with('error', 'Promotion not created');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $promotion = Promotion::findOrFail($request->id);
        $promotion->title = $request->title;
        $promotion->status = $request->status;
        if ($promotion->save()) {
            return redirect()->route('admin.services')->with('success', 'Category has been updated successfully');
        } else {
            return redirect() - back()->with('error', 'Category not updated');
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $promotion = Promotion::findOrFail($request->id);
        if ($promotion->delete()) {
            return response(['success' => true, 'message' => 'Promotion has been deleted successfully']);
        } else {
            return response(['success' => false, 'message' => 'Promotion not deleted']);

        }
    }
}
