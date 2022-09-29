<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Policy;
use Illuminate\Http\Request;

class GenralController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view('admin.others.about', compact('about'));
    }

    public function policy()
    {
        $policy = Policy::first();
        return view('admin.others.policy', compact('policy'));
    }

    public function aboutUpdate(Request $request)
    {
        $request->validate([
            'about_id' => 'required',
            'content' => 'required',
        ]);


        $about = About::findorfail($request->about_id);
        $about->content = $request->content;
        $about->save();
        return view('admin.others.about', compact('about'))->with('success','Content has been updated');
    }

    public function policyUpdate(Request $request)
    {
        $request->validate([
            'policy_id' => 'required',
            'content' => 'required',
        ]);


        $policy = Policy::findorfail($request->policy_id);
        $policy->content = $request->content;
        $policy->save();
        return view('admin.others.policy', compact('policy'))->with('success','Content has been updated');
    }


}
