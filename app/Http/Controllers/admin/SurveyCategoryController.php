<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SurveyCategory;
use File;

class SurveyCategoryController extends Controller
{

    public function index()
    {
    	$categoryLists=SurveyCategory::orderBy('id','DESC')->get();
    	return view('admin.category.index',[
             'categoryLists'=>$categoryLists
            ]);
    }

    public function create(Request $request)
    {
    	    return view('admin.category.add');
    }

    public function store(Request $request)
    {

           $check=SurveyCategory::where('name',$request->name)->first();
           if($check){
            return redirect('admin/category')->with('error','Category Name Already Exists.');
           }

    		$category= new SurveyCategory;
        	$category->name=ucfirst(strtolower($request->name));
        	$category->status=$request->status;

            if($request->hasFile('image'))
            {
                $path=public_path('/category/'.$category->image);
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $name = str_slug($category->name).'.'.rand(111,999).$image->getClientOriginalExtension();
                $destinationPath = public_path('/category');
                
                $image->move($destinationPath, $name);
                $category->image=$name;
            }

        	$category->save();
        	return redirect('admin/category')->with('success','Category added successfully');
    	
    	
    }

    


    public function edit(Request $request,$id)
    {
    		$category= SurveyCategory::find($id);
    	    return view('admin.category.edit',
                ['category'=>$category
            ]);
    }
    	

    public function update(Request $request,$id)
    {

           $check=SurveyCategory::where('name',$request->name)->where('id','!=',$id)->first();
           if($check){
            return redirect('admin/category')->with('error','Category Name Already Exists.');
           } 

    		$category= SurveyCategory::find($id);
        	$category->name=ucfirst(strtolower($request->name));
        	$category->status=$request->status;

            if($request->hasFile('image'))
            {
                $path=public_path('/category/'.$category->image);
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $name = str_slug($category->name).'.'.rand(111,999).$image->getClientOriginalExtension();
                $destinationPath = public_path('/category');
                
                $image->move($destinationPath, $name);
                $category->image=$name;
            }

        	$category->save();
        	return redirect('admin/category')->with('success','Category updated successfully');
    	
    	
    }

    public function delete($id)
    {
    	$id=decrypt($id);
    	$category=Category::where('id',$id)->delete();
        \DB::table('subcategory')->where('cat_id',$id)->delete();
        \DB::table('community')->where('cat_id',$id)->delete();
    	return redirect()->back()->with('success','Category deleted successfully');
    }
}
