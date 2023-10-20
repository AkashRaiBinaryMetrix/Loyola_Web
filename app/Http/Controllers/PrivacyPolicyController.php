<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacypolicy=PrivacyPolicy::first();
        return view('user.privacy_policy')->with(['privacypolicy'=>$privacypolicy]);
    }
}
