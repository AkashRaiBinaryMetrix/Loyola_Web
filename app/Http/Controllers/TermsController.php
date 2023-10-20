<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terms;

class TermsController extends Controller
{
    public function index()
    {
        $terms=Terms::first();
        return view('user.terms_of_use')->with(['terms'=>$terms]);
    }
}
