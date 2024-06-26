<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id', 3)->paginate(10);
        $user = null;
        if(Auth::user()->role_id == 1)
        {
            $users = User::where('role_id', '!=', 1)->paginate(10);
        }
        return view('dashboard.users.index',compact('users','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        User::create($request->all());
        return back()->with(['success' => 'Successfully Add User']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id = null)
    {
        $user = $id ? User::findOrFail($id) : null;
        $title = $id ? "Update User" : "Add User";
        $method = $id ? 'PUT' : 'POST';
        return view('dashboard.users.modal', compact('user', 'title', 'method'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with(['success' => 'Successfully Update User']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with(['success', 'Successfully Delete User']);
    }
}
