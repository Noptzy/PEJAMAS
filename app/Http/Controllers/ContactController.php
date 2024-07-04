<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {

            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%'. $searchTerm. '%')
                  ->orWhere('subject', 'LIKE', '%'. $searchTerm. '%')
                  ->orWhere('email', 'LIKE', '%'. $searchTerm. '%');
        }

        $data = $query->orderBy('created_at', 'ASC')->paginate(10);

        return view('dashboard.contact.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ContactRequest $request)
    {
        try {
            Contact::create($request->all());
            return response()->json(['success', 'Thanks for ur message!']);
        } catch (\Throwable $th){
            return response()->json(['errors',$th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Contact::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Successfully Delete Data');
    }
}
