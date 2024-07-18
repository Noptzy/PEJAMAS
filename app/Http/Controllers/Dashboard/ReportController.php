<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Report;
use App\Models\ImageReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\CitizensRequest;
use App\Http\Requests\Reports\EmployeRequest;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Middleware
     */
    public function __construct(){
        $this->middleware('checkUserProfile');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Report::query();
        $user_id = Auth::user()->id;
        $reports = [];

        if ($request->filled('search')) {

            $searchTerm = $request->input('search');
            $query->where('title', 'LIKE', '%'. $searchTerm . '%')
                  ->orWhere('address','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('lat','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('long','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('status','LIKE',  '%'. $searchTerm . '%');
        }

        $reports = $query->orderBy('created_at', 'ASC')->paginate(10);

        if(Auth::user()->role_id == 3)
        {
            $reports = $query->orderBy('created_at', 'ASC')->where('user_id', $user_id)->paginate(10);
        }

        return view('dashboard.reports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($reportId = null)
    {
        $report = null;

        if($reportId)
        {
            $report = Report::findOrFail($reportId);
        }
        return view('dashboard.reports.create', compact('report'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitizensRequest $request)
    {
        $report = Report::create($request->all());
        $files = $request->file;
        if($files)
        {
            foreach($files as $file){
                $fileName = $this->imageHandler($file, $report->title);
                ImageReport::create([
                    'report_id' => $report->id,
                    'filename' => $fileName
                ]);
            }
        }
        return redirect()->route('dashboard.reports.index')->with('success', 'Report has been send, please for email confirmation');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report, $id = null)
    {
        $report = Report::findOrFail($id);

        if(!$report)
        {
            return back()->with('error', 'Report not found');
        }

        return view('dashboard.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeRequest $request, $id)
    {
        $data = Report::findOrFail($id);
        $data->status = $request->status;
        $data->update();

        return back()->with('success', 'Success updating report');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Report::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Success deleting report');
    }
    /**
     * Image handler resource from storage.
     */
    public function imageHandler($file, $filename)
    {
        try {
            $basePath = public_path('assets/images/reports/');
            $name = time() . uniqid() . '.' . $file->extension();
            $destinationPath = $basePath . $filename;
            $file->move($destinationPath, $name);
            return $name;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
