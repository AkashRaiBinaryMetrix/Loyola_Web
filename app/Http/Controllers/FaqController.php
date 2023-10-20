<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $generalfaqs=Faq::where('type','general')->get();
        $otherfaqs=Faq::where('type','other')->get();
        return view('user.faq')->with(['generalfaqs'=>$generalfaqs,'otherfaqs'=>$otherfaqs]);
    }
}
