<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\DeclineAccountEmail;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = User::query();
        $role = [3];

        if(Auth::user()->role_id == 1)
        {
            $role = [2,3];
        }

        if ($request->filled('search')) {

            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%'. $searchTerm . '%')
                  ->where('role_id','!=',1);

            if(Auth::user()->role_id == 1)
            {
                $query->where('name', 'LIKE', '%'. $searchTerm . '%')
                    ->orWhereHas('roles', function($queryRoles) use ($searchTerm){
                    $queryRoles->where('role', 'LIKE', '%'. $searchTerm . '%');
                });
            }
        }

        $users = $query->orderBy('role_id', 'ASC')->whereIn('role_id', $role)->paginate(10);

        return view('dashboard.users.index',compact('users'));
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
        $user = $request->validated();
        if($request->role_id == 2)
        {
            $user['email_verified_at'] = Carbon::now();
        }
        User::create($user);
        return back()->with(['success' => 'Successfully Add User']);
    }

    /**
     * Display the specified resource.
     */
    public function verifyUser(string $id = null)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.verify', compact('user'))->render();
    }

    /**
     * Verify users.
     */
    public function verifyUserAction(string $id = null)
    {
        $user = User::findOrFail($id);
        $userDetails = $user->details;
        $userDetails->status = 1;
        $userDetails->save();
        return back()->with(['success' => 'Successfully Verify User']);
    }

    /**
     * Decline users.
     */
    public function declineUserAction(string $id = null)
    {
        $user = User::findOrFail($id);
        $actionUrl = route('dashboard.profile');
        Mail::to($user->email)->send(new DeclineAccountEmail($user, $actionUrl));
        return back()->with(['success' => 'Successfully Send Email']);
    }

    /**
     * Display the form users.
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
        return back()->with('success', 'Successfully Delete User');
    }
}
