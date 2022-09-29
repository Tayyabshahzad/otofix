<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::get();
        return view('admin.category.index',compact('services'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function edit($id)
    {
        $category = Service::findorFail($id);
        return view('admin.category.edit',compact('category'));
    }
    public function store(Request $request){
        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'icon' => 'required',
        ]);
        $service = new Service;
        $service->title = $request->title;
        $service->status = $request->status;
        $service->icon_name = $request->icon;
        if($service->save()){
            return redirect()->route('admin.services')->with('success', 'service has been created successfully');
        }else{
            return redirect()->route('admin.category.create')->with('error', 'service not created');
        }
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $service =  Service::findOrFail($request->id);
        $service->title = $request->title;
        $service->status = $request->status;
        $service->icon_name = $request->icon;
        if($service->save()){
            return redirect()->route('admin.services')->with('success', 'Service has been updated successfully');
        }else{
            return redirect()-back()->with('error', 'Service not updated');
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $service =  Service::findOrFail($request->id);
        if($service->delete()){
            return response(['success' => true,'message' => 'Service has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'Service not deleted']);

        }
    }
}
