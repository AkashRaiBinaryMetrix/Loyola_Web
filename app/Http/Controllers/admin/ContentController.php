<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Terms;
use App\Models\PrivacyPolicy;
use App\Models\Faq;
use App\Models\Enquiry;
use DB;

class ContentController extends Controller
{
    public function aboutus(Request $request)
    {
        if($request->isMethod('post'))
        {
            $check=About::first();

            if(empty($check))
            {
                $about=new About;
                $about->about=$request->description;
                $about->content=$request->content;
                if($request->hasFile('image'))
                {
                $image = $request->file('image');
                $name = 'about'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/about');
                $image->move($destinationPath, $name);
                $about->image=$name;
                }
                $about->created_at=\Carbon\Carbon::now();
                $about->updated_at=\Carbon\Carbon::now();
                $about->save();
            }else
            {
                $about=About::where('id',1)->first();
                $about->about=$request->description;
                $about->content=$request->content;
                if($request->hasFile('image'))
                {
                $image = $request->file('image');
                $name = 'about'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/about');
                $image->move($destinationPath, $name);
                $about->image=$name;
                }
                $about->updated_at=\Carbon\Carbon::now();
                $about->save();
            }
            return redirect()->back()->with('success','Data Edited successfully');
        }else
        {
            $about=About::first();
            if(!empty($about))
            {
                $about=$about;
            }else
            {
                $about='';
            }
            return view('admin.content.about_us')->with(['about'=>$about]);
        }
    }

    public function terms_conditions(Request $request)
    {
        if($request->isMethod('post'))
        {
            $check=Terms::first();
            if(empty($check))
            {

                $terms=new Terms;
                $terms->content=$request->content;
                $terms->content1=$request->content1;
                $terms->content2=$request->content2;
                
                $terms->created_at=\Carbon\Carbon::now();
                $terms->updated_at=\Carbon\Carbon::now();
                $terms->save();
            }else
            {
                $terms=Terms::where('id',1)->first();
                $terms->content=$request->content;
                $terms->content1=$request->content1;
                $terms->content2=$request->content2;
                
                $terms->updated_at=\Carbon\Carbon::now();
                $terms->save();
            }
            return redirect()->back()->with('success','Data Edited successfully');
        }else
        {
            $terms=Terms::first();
           
            if(!empty($terms))
            {
                $terms=$terms;
            }else
            {
                $terms='';
            }
            return view('admin.content.terms_conditions')->with(['terms'=>$terms]);
        }
    }

    public function privacy_policy(Request $request)
    {
        if($request->isMethod('post'))
        {
            $check=PrivacyPolicy::first();
            if(empty($check))
            {

                $privacypolicy=new PrivacyPolicy;
                $privacypolicy->content=$request->content;
                $privacypolicy->content1=$request->content1;
                $privacypolicy->content2=$request->content2;
                $privacypolicy->created_at=\Carbon\Carbon::now();
                $privacypolicy->updated_at=\Carbon\Carbon::now();
                $privacypolicy->save();
            }else
            {
                $privacypolicy=PrivacyPolicy::where('id',1)->first();
                $privacypolicy->content=$request->content;
                $privacypolicy->content1=$request->content1;
                $privacypolicy->content2=$request->content2;
                $privacypolicy->updated_at=\Carbon\Carbon::now();
                $privacypolicy->save();
            }
            return redirect()->back()->with('success','Data Edited successfully');
        }else
        {
            $privacypolicy=PrivacyPolicy::first();
           
            if(!empty($privacypolicy))
            {
                $privacypolicy=$privacypolicy;
            }else
            {
                $privacypolicy='';
            }
            return view('admin.content.privacy_policy')->with(['privacypolicy'=>$privacypolicy]);
        }
    }

    public function faq(Request $request)
    {
        if($request->isMethod('post'))
        {
            if(empty($request->id))
            {
                $faq=new Faq;
                $faq->type=$request->type;
                $faq->question=$request->question;
                $faq->answer=$request->answer;
                $faq->created_at=\Carbon\Carbon::now();
                $faq->updated_at=\Carbon\Carbon::now();
                $faq->save();
            }
            return redirect()->back()->with('success','Faq Added successfully');
        }else
        {
            
            return view('admin.content.faq');
        }
    }

    public function editfaq(Request $request,$id)
    {
        $newid=decrypt($id);
        if($request->isMethod('post'))
        {
            
                $faq=Faq::where('id',$newid)->first();
                $faq->type=$request->type;
                $faq->question=$request->question;
                $faq->answer=$request->answer;
                $faq->created_at=\Carbon\Carbon::now();
                $faq->updated_at=\Carbon\Carbon::now();
                $faq->save();
            
            return redirect()->back()->with('success','Faq Edited successfully');
        }else
        {
            $faq=Faq::where('id',$newid)->first();
            return view('admin.content.faq')->with(['faq'=>$faq,'id'=>$id]);
        }
    }

    public function managefaq(Request $request)
    {
        $faq=Faq::all();
        return view('admin.content.manage_faq')->with(['faq'=>$faq]);
    }

    public function deletefaq(Request $request,$id)
    {
        $newid=decrypt($id);
        Faq::where('id',$newid)->delete();
        return redirect()->back()->with('success','Faq Deleted successfully');
    }

    public function manage_enquiry()
    {
        $allenquiry=Enquiry::all();
        return view('admin.content.manage_enquiry')->with(['allenquiry'=>$allenquiry]);
    }

    public function delete_enquiry(Request $request,$id)
    {
        $newid=decrypt($id);
        Enquiry::where('id',$newid)->delete();
        return redirect()->back()->with('success','Enquiry Deleted successfully');
    }

    public function contact_us(Request $request)
    {
        if($request->isMethod('post'))
        {
            $check=DB::table('contact_us')->first();
            if(empty($check))
            {
                DB::table('contact_us')->insert(['contact'=>$request->contact_us,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);
                 return redirect()->back()->with('success','Contact details added successfully');
            }else
            {
                  DB::table('contact_us')->where('id',1)->update(['contact'=>$request->contact_us,'updated_at'=>\Carbon\Carbon::now()]);
                 return redirect()->back()->with('success','Contact details Edited successfully');
            }
            
        }else
        {
            $contactus=DB::table('contact_us')->first();
            return view('admin.content.contact_us')->with(['contact'=>$contactus]);
        }
        
    }


    
}
