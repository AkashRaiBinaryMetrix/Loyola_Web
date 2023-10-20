<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact_us');
    }

    public function enquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:enquiry',
            'phone' => 'required',
            'message' => 'required',
            ]);

        $enquiry=new Enquiry;
        $enquiry->first_name=$request->first_name;
        $enquiry->last_name=$request->last_name;
        $enquiry->email=$request->email;
        $enquiry->phone=$request->phone;
        $enquiry->message=$request->message;
        $enquiry->save();
        return redirect()->back()->with('success','We have received your enquiry we will get back to you soon');
    }
}
