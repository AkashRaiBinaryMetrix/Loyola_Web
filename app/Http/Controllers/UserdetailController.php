<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_detail;
use Session;


class UserdetailController extends Controller
{
 public function Save(Request $request)
    {
      
      $user=\Session::get('user');
        $check=User_detail::where('user_id',$user->id)->first();

        if(empty($check))
            {
               
               $detail = new User_detail();           
               $detail->phone = $request->Input(['phone']);            
               $detail->gender = $request->Input(['gender']);
               $detail->age = $request->Input(['age']);
               $detail->city = $request->Input(['city']);
               $detail->state = $request->Input(['state']);
               $detail->country = $request->Input(['country']);
               $detail->zipcode = $request->Input(['zipcode']);
               $detail->user_id=   $user->id;
               $detail->save();

               if($request->hasFile('image'))
                {
                $image = $request->file('image');
                $image_name = 'user'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension(); 
                $destinationPath = public_path('user/images');
                $detail->image=$image_name;
                $image->move($destinationPath, $image_name);
                }
                 User::where('id',$user->id)->update(['name'=>$request->name]);

            }else
            {
               $detail = User_detail::where('user_id',$user->id)->first();          
               $detail->phone = $request->Input(['phone']);            
               $detail->gender = $request->Input(['gender']);
               $detail->age = $request->Input(['age']);
               $detail->city = $request->Input(['city']);
               $detail->state = $request->Input(['state']);
               $detail->country = $request->Input(['country']);
               $detail->zipcode = $request->Input(['zipcode']);
               if($request->hasFile('image'))
                {
                $image = $request->file('image');
                $image_name = 'user'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension(); 
                $destinationPath = public_path('user/images');
                $detail->image=$image_name;
                $image->move($destinationPath, $image_name);
                }
               $detail->save();
               User::where('id',$user->id)->update(['name'=>$request->name]);
            }
         return redirect()->back()->with('success','Your profile updated successfully');
    }

}