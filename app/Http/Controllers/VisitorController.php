<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $visitors = Visitor::with('deceased_details')->orderBy('id', 'desc')->get();
        return view('visitors.visitors', compact('visitors'));
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
        //
        $request->validate([
            'fullname' => 'required',
            'address' => 'required',
            'date_in' => 'required',
            'time_in' => 'required',
            'deceased_id' => 'required',
        ]);

        $visitor = Visitor::create($request->all());
        //return redirect()->route('panel.deceaseds.show', ['deceased' => $request->deceased_id]);
        //return redirect('/panel/deceaseds/'. $request->deceased_id);
        //return response()->json($deceased);
        session()->flash('success', 'Visitor successfully saved.');
        return response()->json([
            'success' => true,
            'message' => 'Visitor successfully saved.',
            'redirect_url' => route('panel.deceaseds.show', ['deceased' => $request->deceased_id]),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
