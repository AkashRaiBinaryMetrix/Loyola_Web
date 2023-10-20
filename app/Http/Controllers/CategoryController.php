<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function all_category()
    {
    	$community=Community::orderBy('community.title','ASC')->get();
        $category=\DB::table('category')->orderBy('category.title','ASC')->get();
        $poll=\DB::table('admin_poll')->where('status',1)->first();
        $poll_option= json_decode($poll->poll_options);
        $extension=explode('.',$poll->media);  
         if(!empty(\Session::get('user')))
         {
            $mycommunity=\DB::table('community')
	                     ->leftjoin('community_join','community.id','community_join.community_id')
	                      ->where('community_join.user_id',\Session::get('user')->id)
	                      ->where('community_join.status',1)
	                      ->groupBy('community.id')
                          ->take(6)
	                      ->get(); 
	      }else
	      {
	        $mycommunity=\DB::table('community')
	                     ->leftjoin('community_join','community.id','community_join.community_id')
	                      ->groupBy('community.id')
                          ->take(6)
	                      ->get(); 
	      }
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count(); 
    	 return view('user.all_categories')->with(['community'=>$community,'mycommunity'=>$mycommunity,'category'=>$category,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes]);
    }
    public function search_category(Request $request)
    {
        $community=Community::orderBy('subcategory.name','ASC')->get();
        $category=\DB::table('category')->where('title',$request->name)->orderBy('category.title','ASC')->get();
        $poll=\DB::table('admin_poll')->where('status',1)->first();
        $poll_option= json_decode($poll->poll_options);
        $extension=explode('.',$poll->media);  
         if(!empty(\Session::get('user')))
         {
            $mycommunity=\DB::table('community')
                         ->leftjoin('community_join','community.id','community_join.community_id')
                          ->where('community_join.user_id',\Session::get('user')->id)
                          ->where('community_join.status',1)
                          ->groupBy('community.id')
                          ->take(6)
                          ->get(); 
          }else
          {
            $mycommunity=\DB::table('community')
                         ->leftjoin('community_join','community.id','community_join.community_id')
                          ->groupBy('community.id')
                          ->take(6)
                          ->get(); 
          }
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count(); 
         return view('user.all_categories')->with(['community'=>$community,'mycommunity'=>$mycommunity,'category'=>$category,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes]);
    }
    public function search_subcategory(Request $request)
    {
        $url=$request->path();
        $data=$request->all();
        $catid=\DB::table('category')->where('slug',$data['cat_id'])->first();
        $subcategory=SubCategory::leftjoin('category','category.id','subcategory.cat_id')->where('subcategory.continent',$data['continent'])->where('subcategory.cat_id',$data['cat_id'])->where('subcategory.name',$data['name'])->select('subcategory.*','category.title','category.slug as catslug')->get();
        if(!empty(\Session::get('user')))
        {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->where('community_join.user_id',\Session::get('user')->id)
                      ->where('community_join.status',1)
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }else
        {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }
        $category=\DB::table('category')->take(6)->get();
        $poll=\DB::table('admin_poll')->where('status',1)->first();
         $poll_option= json_decode($poll->poll_options);
         $extension=explode('.',$poll->media);  
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count(); 
          return view('user.all_subcategory')->with(['subcategory'=>$subcategory,'mycommunity'=>$mycommunity,'category'=>$category,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'cat_id'=>$data['cat_id'],'continent'=>$data['continent']]);
    }
}
