<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\UserCommunity;

use App\Models\Community;

use App\Models\Category;

use App\Models\SubCategory;

use DB;

use File;

use Intervention\Image\Facades\Image;



class CommunityController extends Controller

{

    public function add_community(Request $request)

    {

        if($request->isMethod('post'))

        {

            date_default_timezone_set('UTC');

            $usercommunity=new UserCommunity;

            $usercommunity->user_id=\Session::get('user')->id;

            $usercommunity->name=$request->name;

            $usercommunity->description=$request->description;

            

            $checkcomm=Community::where('title',$request->name)->first();

            if(!empty($checkcomm))

            {

              return redirect()->back()->with('error','This community already exist!');

            }

            if(!empty($request->image))

            {

                $originalImage= $request->file('image');

                $thumbnailImage = Image::make($originalImage);

                $thumbnailPath = public_path().'/community_image/';

                if (! File::exists($thumbnailPath))

                {

                    File::makeDirectory($thumbnailPath, 0777, true, true);

                }

                $rand=rand(1111,9999);

                $originalPath = public_path().'/community/';

                if (! File::exists($originalPath))

                {

                    File::makeDirectory($originalPath, 0777, true, true);

                }

                $thumbnailImage->save($originalPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $thumbnailImage->resize(100,100);

                $thumbnailImage->save($thumbnailPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $usercommunity->image='community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();

            }

            if(!empty($request->cover_image))

            {

                 

                $originalImage= $request->file('cover_image');

                $thumbnailImage = Image::make($originalImage);

                $thumbnailPath = public_path().'/community_image/';

                if (! File::exists($thumbnailPath))

                {

                    File::makeDirectory($thumbnailPath, 0777, true, true);

                }

                $rand=rand(1111,9999);

                $originalPath = public_path().'/community/';

                if (! File::exists($originalPath))

                {

                    File::makeDirectory($originalPath, 0777, true, true);

                }

                $thumbnailImage->save($originalPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $thumbnailImage->resize(800,350);

                $thumbnailImage->save($thumbnailPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $usercommunity->cover_image='community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();

            }

            $usercommunity->created_at=\Carbon\Carbon::now();

            $usercommunity->updated_at=\Carbon\Carbon::now();

            $usercommunity->save();



            $community=new Community;

            $community->user_community=\Session::get('user')->id;

            $community->title=$request->name;

            $community->description=$request->description;

            //get continent id
            $continentsID = DB::table('continents')->where([["name",$request->continent]])->get();

            $community->continent=$continentsID[0]->id;
            $community->cat_id=$request->category_res;
            $community->subcat_id=$request->subcategory_res;

            $checkcomm=Community::where('title',$request->name)->first();

            if(!empty($checkcomm))

            {

              return redirect()->back()->with('error','This community already exist!');

            }

            if(!empty($request->image))

            {

                $originalImage= $request->file('image');

                $thumbnailImage = Image::make($originalImage);

                $thumbnailPath = public_path().'/community_image/';

                if (! File::exists($thumbnailPath))

                {

                    File::makeDirectory($thumbnailPath, 0777, true, true);

                }

                $rand=rand(1111,9999);

                $originalPath = public_path().'/community/';

                if (! File::exists($originalPath))

                {

                    File::makeDirectory($originalPath, 0777, true, true);

                }

                $thumbnailImage->save($originalPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $thumbnailImage->resize(100,100);

                $thumbnailImage->save($thumbnailPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $community->image='community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();

            }

            if(!empty($request->cover_image))

            {

                $originalImage= $request->file('cover_image');

                $thumbnailImage = Image::make($originalImage);

                $thumbnailPath = public_path().'/community_image/';

                if (! File::exists($thumbnailPath))

                {

                    File::makeDirectory($thumbnailPath, 0777, true, true);

                }

                $rand=rand(1111,9999);

                $originalPath = public_path().'/community/';

                if (! File::exists($originalPath))

                {

                    File::makeDirectory($originalPath, 0777, true, true);

                }

                $thumbnailImage->save($originalPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $thumbnailImage->resize(800,350);

                $thumbnailImage->save($thumbnailPath.'community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                $community->cover_image='community'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();

            }

            $community->created_at=\Carbon\Carbon::now();

            $community->updated_at=\Carbon\Carbon::now();

            $community->save();



                  $activity['post_id']=$community->id;

                  $activity['like_id']='';

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['status']='You requested to approve a community';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

                

            return redirect()->back()->with('success','Your Community added successfully');

        }else

        {   
            //get continent details
            $continentsList = DB::table('continents')->get();

            return view('user.create_community',['continentsList'=>$continentsList]);

        }

    }



    public function communities(Request $request)

    {

        $community=Community::get();

        $url=last(request()->segments());

        $categoryall=\DB::table('category')->take(6)->get();

        $category=\DB::table('category')->where('continent',1)->get();

        $poll=\DB::table('admin_poll')->where('status',1)->first();

        $url=$request->path();

        $catid=\DB::table('category')->where('slug',$url)->first();

        

        $query=\DB::table('category')

                ->leftjoin('continents','category.continent','continents.id')

                ->where('continent_id',$url);

                if(!empty($request->name))

                {

                   $query->where('category.title',$request->name);

                }

                $query->select('category.*','continents.name as conname');

                $query->orderBy('category.title','ASC');

        $categorylist=$query->get();

        // $subcat=\DB::table('category')

        //         ->leftjoin('category','category.id','subcategory.cat_id')

        //         ->where('cat_id',$catid->id)

        //         ->select('subcategory.*','category.title','category.slug as catslug')

        //         ->orderBy('subcategory.name')

        //         ->groupBy('subcategory.id')

        //         ->get();

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

        return view('user.asia')->with(['community'=>$community,'mycommunity'=>$mycommunity,'category'=>$categoryall,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'categoryall'=>$category,'url'=>$url,'categorylist'=>$categorylist]);

    }



    public function all_community()

    {

        $community=Community::orderBy('community.title','ASC')->get();

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

        return view('user.all_community')->with(['community'=>$community,'mycommunity'=>$mycommunity,'category'=>$category,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes]);

    }




}

