<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use App\Models\UserPost;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $community=DB::table('community')->get();
        return view('admin.poll.add_poll')->with(['community'=>$community]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $poll['community_id']=$request->community_id;
        $poll['question']=$request->question;
        $poll['poll_options']=json_encode($request->option);
        $poll['multiple']=$request->multiple;
        $poll['status']=0;
        if($request->hasFile('media'))
            {
                $image = $request->file('media');
                $name = 'poll'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/poll');
                
                $image->move($destinationPath, $name);
                $poll['media']=$name;
            }
             
        $poll['time']=\Carbon\Carbon::now();
        $poll['created_at']=\Carbon\Carbon::now();
        $poll['updated_at']=\Carbon\Carbon::now();
        DB::table('admin_poll')->insert($poll);
        return redirect()->back()->with(['success'=>'Poll created successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
    
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $poll=DB::table('admin_poll')->get();
        return view('admin.poll.manage')->with(['allpoll'=>$poll]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newid=decrypt($id);
        $poll=DB::table('admin_poll')->where('id',$newid)->first();
        $community=DB::table('community')->get();
        $options=json_decode($poll->poll_options);
         $extension=explode('.',$poll->media);
        return view('admin.poll.edit')->with(['poll'=>$poll,'community'=>$community,'options'=>$options,'extension'=>$extension]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $check=DB::table('admin_poll')->where('id',$request->id)->first();
        $poll['question']=$request->question;
        $poll['poll_options']=json_encode($request->option);
        $poll['multiple']=$request->multiple;
        $poll['status']=$check->status;

        if($request->hasFile('media'))
        {
            $path=public_path().'/poll/'.$check->media;
           
            if(File::exists($path))
            {
                
                File::delete($path);
            }
            $image = $request->file('media');
            $name = 'poll'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/poll');
            
            $image->move($destinationPath, $name);
            $poll['media']=$name;
        }   
        $poll['time']=$check->time;
        $poll['updated_at']=\Carbon\Carbon::now();
        DB::table('admin_poll')->where('id',$request->id)->update($poll);
        return redirect()->back()->with(['success'=>'Poll edited successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newid=decrypt($id);
        DB::table('admin_poll')->where('id',$newid)->delete();
        DB::table('admin_poll_votes')->where('poll_id',$newid)->delete();
        return redirect()->back()->with(['success'=>'Poll deleted successfully']);
    }

    public function view_poll_details(Request $request,$id)
    {
        $newid=decrypt($id);
        $poll=DB::table('admin_poll')->where('id',$newid)->where('status',1)->first();
        $options=json_decode($poll->poll_options);
        return view('admin.poll.view_poll_details')->with(['poll'=>$poll,'options'=>$options]);
    }

    public function status($id,$status)
    {
        $newid=decrypt($id);
        $check=DB::table('admin_poll')->where('status',1)->update(['status'=>0]);
        DB::table('admin_poll')->where('id',$newid)->update(['status'=>$status]);
        return redirect()->back()->with(['success'=>'Status updated successfully']);
    }
}
