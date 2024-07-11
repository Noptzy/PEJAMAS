<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ImageReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Report;

class ImageReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        $report = $this->getReportId($id);
        $images = ImageReport::where('report_id', $report->id)->paginate(10);

        return view('dashboard.reports.image', compact('images','report'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = null;
        if($request->filename)
        {
            $fileindex = Report::findOrfail($request->report_id);
            $name = $this->imageHandler($request->filename, $fileindex->title);
        }
        ImageReport::create([
            'report_id' => $request->report_id,
            'filename' => $name
        ]);
        return back()->with('success', 'Success add image');
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null, $type)
    {
        $data = null;

        if($type == 'show')
        {
            $image = ImageReport::findOrFail($id);
            $report = Report::findOrFail($image->report_id);
            $data = [
                'image' => $image,
                'report' => $report
            ];
        }
        else
        {
            $data = $type;
        }
        return view('dashboard.reports.modal', compact('data','type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageReport $imageReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageReport $imageReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $image = ImageReport::findOrFail($id);
            $report = Report::findOrFail($image->report_id);

            $filePath = public_path('assets/images/reports/'.$report->title.'/'.$image->filename);

            // Check if file exists before attempting to delete
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // Delete the database record
            $image->delete();

            return back()->with('success', 'Successfully deleted image');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete image: '.$e->getMessage());
        }
    }
    /**
     * Get the specified reports.
     */
    protected function getReportId($id)
    {
        $data = Report::findOrFail($id);
        return $data;
    }

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
