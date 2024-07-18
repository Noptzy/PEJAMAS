<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $feedbacks = \App\Models\Feedback::where('status',1)->get();
        return view('index', compact('feedbacks'));
    }
}
