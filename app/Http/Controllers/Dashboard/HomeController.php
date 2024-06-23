<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = \App\Models\User::where('role_id', '!=', 1)->count();
        $citizens = \App\Models\User::where('role_id', 3)->count();
        return view('dashboard.index', compact('users', 'citizens'));
    }
}
