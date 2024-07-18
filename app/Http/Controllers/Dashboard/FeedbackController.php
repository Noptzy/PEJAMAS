<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('checkUserProfile');
    }

    public function index(Request $request)
    {
        $query = Feedback::query();
        $user_id = Auth::user()->id;
        $feedbacks = [];

        if ($request->filled('search')) {

            $searchTerm = $request->input('search');
            $query->where('title', 'LIKE', '%'. $searchTerm . '%')
                  ->orWhere('address','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('lat','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('long','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('status','LIKE',  '%'. $searchTerm . '%');
        }

        $feedbacks = $query->with(['report','user'])->orderBy('created_at', 'ASC')->paginate(10);

        if(Auth::user()->role_id == 3)
        {
            $feedbacks = $query->orderBy('created_at', 'ASC')->where('user_id', $user_id)->paginate(10);
        }

        return view('dashboard.feedback.index',compact('feedbacks','user_id'));
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
    public function store(Request $request)
    {
        $reportChecker = Report::where('id', $request->report_id)->first();
        if(!$reportChecker || $reportChecker?->status != 'done')
        {
            return back()->with('error', 'Report tidak ditemukan');
        }
        Feedback::create($request->all());
        return back()->with('success', 'Success create feedbacks, Thank You!');
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $reports = Report::where('user_id', $userId)->where('status','done')->get();
        return view('dashboard.feedback.modal', compact('reports', 'userId'));
    }

    public function statusChange($id)
    {
        $feedback = Feedback::findOrFail($id);
        try {

            if($feedback->status)
            {
                $feedback->status = 0;
            }else{
                $feedback->status = 1;
            }

            $feedback->update();

            return back()->with('success', 'Success update status!');
        } catch (\Throwable $th) {

            return back()->with('error', 'Failed to delete image: '.$th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
