<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class VideoController extends Controller
{
    public function add(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		 $validated = $request->validate([
            'title' => 'required',
            'url' => 'required',
             ]);
    	DB::table('videos')->insert(['title'=>$request->title,'url'=>$request->url,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);
    	return redirect()->back()->with('success','Video added successfully');
    	}else 
    	{
    		return view('admin.videos.add');
    	}
    }

    public function manage()
    {
    	$videos=DB::table('videos')->get();
    	return view('admin.videos.manage',['videos'=>$videos]);
    }

    public function edit(Request $request,$id)
    {
    	$newid=decrypt($id);
    	if($request->isMethod('post'))
    	{
    		 $validated = $request->validate([
            'title' => 'required',
            'url' => 'required',
             ]);
    	DB::table('videos')->where('id',$newid)->update(['title'=>$request->title,'url'=>$request->url,'updated_at'=>\Carbon\Carbon::now()]);
    	return redirect()->back()->with('success','Video edited successfully');
    	}else 
    	{
    		$video=DB::table('videos')->where('id',$newid)->first();
    		return view('admin.videos.edit',['id'=>$id,'video'=>$video]);
    	}
    }

    public function delete($id)
    {
    	$newid=decrypt($id);
    	DB::table('videos')->where('id',$newid)->delete();
    	return redirect()->back()->with('success','Video deleted successfully');
    }
}
