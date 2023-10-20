<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function add_subcategory(Request $request)
    {
    	if($request->isMethod('post'))
        {
        	$find=SubCategory::where('continent',$request->continent)->where('cat_id',$request->cat_id)->where('name',$request->name)->first();
            if($find)
            {
                return redirect()->back()->with('error','SubCategory already exist');
            }
        	$subcategory= new SubCategory;
        	$subcategory->cat_id=$request->cat_id;
            $subcategory->name=$request->name;
        	$subcategory->status=$request->status;
            $subcategory->continent=$request->continent;
            $subcategory->slug=str_slug($request->name);
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $name = 'subcat'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/subcat');
                
                $image->move($destinationPath, $name);
                $subcategory->image=$name;
            }
        	$subcategory->created_at=\Carbon\Carbon::now();
        	$subcategory->updated_at=\Carbon\Carbon::now();
        	$subcategory->save();
        	return redirect()->back()->with('success','Sub Category added successfully');
        }else
        {
            $category=Category::whereNull('continent')->get();
            $continent=\DB::table('continents')->get();
        	return view('admin.subcategory.add')->with(['category'=>$category,'continent'=>$continent]);
        }
    }

    public function manage_subcategory()
    {
    	$subcategory=SubCategory::
                     leftjoin('category','category.id','subcategory.cat_id')
                     ->select('subcategory.*','category.title')
                     ->groupBy('subcategory.id')
                    ->get();
    	return view('admin.subcategory.manage')->with(['subcategory'=>$subcategory]);
    }

    public function edit_subcategory(Request $request,$id)
    {
    	$newid=decrypt($id);
    	if($request->isMethod('post'))
    	{
            $check=SubCategory::where('id',$newid)->where('name',$request->name)->first();
            if(!empty($check))
            {
                
            }else
            {
                $checktitle=SubCategory::where('continent',$request->continent)->where('cat_id',$request->cat_id)->where('name',$request->name)->first();
                if(!empty($checktitle))
                {
                    return redirect()->back()->with('error','SubCategory already exist!');
                }  
            }
    		$subcategory= SubCategory::where('id',$newid)->first();
        	$subcategory->cat_id=$request->cat_id;
            $subcategory->name=$request->name;
        	$subcategory->status=$request->status;
            $subcategory->continent=$request->continent;
        	$subcategory->slug=str_slug($request->name);
            if($request->hasFile('image'))
            {
                $path=public_path('/subcat/'.$subcategory->image);
                if(\File::exists($path))
                {
                    \File::delete($path);
                }
                $image = $request->file('image');
                $name = 'subcat'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/subcat');
                
                $image->move($destinationPath, $name);
                $subcategory->image=$name;
            }
        	$subcategory->updated_at=\Carbon\Carbon::now();
        	$subcategory->save();
        	return redirect()->back()->with('success','Sub Category edited successfully');
    	}else
    	{
            $category=Category::whereNull('continent')->get();
    		$subcategory=SubCategory::where('id',$newid)->first();
            $continent=\DB::table('continents')->get();
    	    return view('admin.subcategory.edit')->with(['subcategory'=>$subcategory,'id'=>$id,'category'=>$category,'continent'=>$continent]);
    	}
    	
    }

    public function delete_subcategory($id)
    {
        
    	$id=decrypt($id);
    	$category=SubCategory::where('id',$id)->delete();
        Category::where('id',$id)->delete();
        \DB::table('community')->where('cat_id',$id)->delete();
    	return redirect()->back()->with('success','Sub Category deleted successfully');
    }
}
