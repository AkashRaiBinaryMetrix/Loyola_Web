<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\User;
use DB;
use File;
use Intervention\Image\Facades\Image;

class CommunityController extends Controller
{
    public function add_community(Request $request)
    {
        if($request->isMethod('post'))
        {

            $checkcomm=Community::where('cat_id',$request->cat_id)->where('subcat_id',$request->subcat_id)->where('title',$request->title)->first();
            if(!empty($checkcomm))
            {
                return redirect()->back()->with('error','This Community is already added!');
            }
            $community=new Community;
            $community->title=$request->title;
            $community->description=$request->description;
            $community->cat_id=$request->cat_id;
            $community->subcat_id=$request->subcat_id;
            $community->continent=$request->continent;
            $community->created_at=\Carbon\Carbon::now();
            $community->updated_at=\Carbon\Carbon::now();
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
            $community->save();
            // return response()->json(['success'=>'Community added successfully!']);
            return redirect()->route('admin.manage.community')->with('success','Community added successfully!');
        }else
        {
            $continent=\DB::table('continents')->get();
            $category=\DB::table('category')->whereNull('continent')->get();
            return view('admin.community.add_community',['category'=>$category,'continent'=>$continent]);
        }
    }

    public function manage_community(Request $request)
    {
        $community=Community::
                    leftjoin('category','community.cat_id','category.id')
                    ->leftjoin('subcategory','community.subcat_id','subcategory.id')
                    ->select('category.title as category','subcategory.name as subcategory','community.*')
                    ->get();
        return view('admin.community.manage_community')->with(['community'=>$community]);
    }

    public function requested_appointment()
    {
        $appointment = DB::table('upcoming_appointments')->get();

        return view('admin.community.requested_appointment')->with(['appointment'=>$appointment]);
    }

    public function manage_counselor()
    {
        $counselor = DB::table('users')->where('type','doctor')->get();

        return view('admin.community.manage_counselor')->with(['counselor'=>$counselor]);
    }


    public function patient_listing()
    {
        $patient = DB::table('users')->where('type','patient')->get();

        return view('admin.community.patient_listing')->with(['patient'=>$patient]);
    }

    public function edit_counselor(Request $request,$id)
    {
        $counselor = DB::table('users')->where('id',$id)->get();

        return view('admin.community.edit_counselor')->with(['counselor'=>$counselor]);
    }

    public function update_counselor(Request $request,$id)
    {     
        $counselor = DB::table('users')->where('id',$id)->update();

        return view('admin.community.edit_counselor')->with(['counselor'=>$counselor]);
    }

    public function edit_counselor_process(Request $request)
    {
        $id    = $request->record_id;
        $name    = $request->name;
        $email   = $request->email;
        $phone   = $request->phone;
        $gender   = $request->gender;
        $age   = $request->age;
        $location   = $request->location;

        $weight   = $request->weight;
        $height   = $request->height;
        $city   = $request->city;
        $country   = $request->country;
        $doctor_qualification   = $request->doctor_qualification;
        $doctor_experience   = $request->doctor_experience;
        $services_type   = $request->services_type;
        $doctor_fess   = $request->doctor_fess;

        $designation   = $request->designation;
        $doctor_experience   = $request->doctor_experience;


        $counselor = DB::table('users')->where('id','=',$id)->update(array(
            'name'          => $name,
            'email'         => $email,
            'designation'   => $designation,
            'phone'         => $phone,
            'gender'        => $gender,
            'age'           => $age,
            'location'      => $location,
            'doctor_experience'      => $doctor_experience,
            'weight'        => $weight,
            'height'           => $height,
            'city'      => $city,
            'country'      => $country,
            'doctor_qualification'        => $doctor_qualification,
            'services_type'           => $services_type,
            'doctor_fess'      => $doctor_fess
        ));

        $counselor = DB::table('users')->where('id',$id)->get();

        return view('admin.community.manage_counselor')->with(['counselor'=>$counselor]);        

    }


    public function edit_listing(Request $request,$id)
    {
        $patient = DB::table('users')->where('id',$id)->get();

        return view('admin.community.edit_listing')->with(['patient'=>$patient]);
    }

    public function update_patient(Request $request,$id)
    {     
        $patient = DB::table('users')->where('id',$id)->update();

        return view('admin.community.edit_listing')->with(['patient'=>$patient]);
    }

    public function edit_patient_process(Request $request)
    {
        $id    = $request->record_id;
        $name    = $request->name;
        $phone   = $request->phone;
        $gender   = $request->gender;
        $blood_group   = $request->blood_group;
        $country   = $request->country;
        

        $patient = DB::table('users')->where('id','=',$id)->update(array(
            'name'         => $name,
            'phone'   => $phone,
            'gender'   => $gender,
            'blood_group'   => $blood_group,
            'country'   => $country,
        ));

        $patient = DB::table('users')->where('type','patient')->get();

        return view('admin.community.patient_listing')->with(['patient'=>$patient]);        

    }


    public function add_counselor()
    {
        $counselor = DB::table('users')->get();

        return view('admin.community.add_counselor')->with(['counselor'=>$counselor]);
    }

    public function insert_counselor(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $gender = $request->gender;
        $age = $request->name;
        $location = $request->location;
        $phone = $request->phone;
        $type = $request->type;
        $doctor_experience = $request->doctor_experience;
        $designation = $request->designation;

        $check=User::where('email',$request->email)->first();
        if(!empty($check))
        {
            return redirect()->back()->with('error','Email id already exist!');
        }else{
            $insert = DB::table('users')->insertGetId([
                'name'       => $name,
                'email'      => $email,
                'gender'     => $gender,
                'age'        => $age,
                'location'   => $location,
                'phone'      => $phone,
                'type'       => $type,
                'designation'      => $designation,
                'doctor_experience'       => $doctor_experience,
                
            ]);
        return view('admin.community.add_counselor')->with(['insert'=>$insert]);
        }
        
    }


    public function edit(Request $request,$id)
    {
        if($request->isMethod('post'))
        {
            $check=Community::where('id',$id)->where('title',$request->title)->first();
            if(!empty($check))
            {
                
            }else
            {
                $checktitle=Community::where('cat_id',$request->cat_id)->where('subcat_id',$request->subcat_id)->where('title',$request->title)->first();
                if(!empty($checktitle))
                {
                    return redirect()->back()->with('error','Community already exist!');
                }  
            }
            $community=Community::where('id',$id)->first();
            $community->title=$request->title;
            $community->description=$request->description;
            $community->cat_id=$request->cat_id;
            $community->subcat_id=$request->subcat_id;
            $community->continent=$request->continent;
            if($request->hasFile('image'))
            {
                $destinationPath = public_path('/community');
                $image_path=$destinationPath.'/'.$community->image;
                if (File::exists($destinationPath)) 
                {
                    File::delete($image_path);
                }

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
                $destinationPath = public_path('/community');
                $image_path=$destinationPath.'/'.$community->cover_image;
                if (File::exists($destinationPath)) 
                {
                    File::delete($image_path);
                }

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
            $community->save();
            return redirect()->back()->with('success','Community Edited successfully!');
        }else
        {
            $continent=\DB::table('continents')->get();
            $category=\DB::table('category')->whereNull('continent')->get();
            $subcategory=\DB::table('subcategory')->get();
            $community=Community::where('id',$id)->first();
            return view('admin.community.edit_community')->with(['community'=>$community,'category'=>$category,'subcategory'=>$subcategory,'continent'=>$continent]);
        }
    }

    public function delete(Request $request,$id)
    {
        $check=Community::where('id',$id)->delete();
        \DB::table('admin_poll')->where('community_id',$id)->delete();
        \DB::table('community_join')->where('community_id',$id)->delete();
        \DB::table('poll_votes')->where('community_id',$id)->delete();
        \DB::table('user_comments')->where('community_id',$id)->delete();
        \DB::table('user_poll')->where('community_id',$id)->delete();
        \DB::table('user_posts')->where('community_id',$id)->delete();
        if($check)
        {
            return redirect()->back()->with('success','Community Deleted successfully!');
        }else
        {
            return redirect()->back()->with('danger','Server Error try after some time!');
        }
    }

    public function uploadimg(Request $request)
    {

        if($request->hasFile('upload'))
        {
            $originName=$request->file('upload')->getClientOriginalName();
            $fileName=pathinfo($originName,PATHINFO_FILENAME);
            $extension=$request->file('upload')->getClientOriginalExtension();
            $fileName=$fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('community'),$fileName);
            $CKEditorFuncNum=$request->input('CKEditorFuncNum');
            $url=asset('community/'.$fileName);
            $msg='Image uploaded successfully';
            $response="<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$msg')</script>";
            
            @header('Content-Type: text/html; charset-utf-8');
            echo $response;
        }
    }

    public function community_request(Request $request)
    {
        if($request->isMethod('post'))
        {
            // dd($request->all());
            $check=\DB::table('user_community')->where('id',$request->commid)->first();
            \DB::table('user_community')->where('id',$request->commid)->update(['status'=>$request->status]);
            $checkcomm=\DB::table('community')->where('user_community',$request->commid)->where('title',$check->name)->first();
            if(empty($checkcomm) && ($request->status==1))
            {
                $data['title']=$check->name;
                $data['description']=$check->description;
                $data['image']=$check->image;
                $data['cover_image']=$check->cover_image;
                $data['user_community']=$check->id;
                $data['created_at']=$check->created_at;
                $data['updated_at']=$check->updated_at;
                \DB::table('community')->insert($data);
            }
            if(!empty($checkcomm) && $request->status==0)
            {
                \DB::table('community')->where('user_community',$request->commid)->delete();
            }
            $res['status']='true';
            return $res;
        }else
        {
            $community_request=\DB::table('user_community')->get();
            return view('admin.community.manage_community_request')->with(['request'=>$community_request]);
        }
        
    }


    public function myactivate(Request $request)
    {
        \DB::table('users')->where('id',$request->id)->update(['status'=>'1']); 
    }

    public function deactivate(Request $request){
        \DB::table('users')->where('id',$request->id)->update(['status'=>'0']);
    }

    public function subcatlist(Request $request)
    {
        $data=$request->all();
        $catid=$data['catid'];
        $subcat=\DB::table('subcategory')->where('cat_id',$catid)->get()->toArray();
        return $subcat;
        
    }
}
