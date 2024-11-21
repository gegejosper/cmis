<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Graveyard;
use App\Models\Block;

class GraveyardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $graveyards = Graveyard::get();
        return view('graveyards.graveyards', compact('graveyards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('graveyards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'graveyard_name' => 'required',
            'block_numbers' => 'required',
        ]);

        $graveyard = Graveyard::create($request->all());
        $block_number = 1;
        while($request->block_numbers >= $block_number ){
            $block = new Block();
            $block->block_name = $block_number;
            $block->graveyard_id = $graveyard->id;
            $block->status = 'available';
            $block->save();
            $block_number += 1;
        }

        if ($request->hasFile('graveyard_image')) {
            $file = $request->file('graveyard_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $file_path = $file->storeAs('uploads/employees', $filename, 'public'); // Adjust the path as needed
            $file_path = 'graveyards/' . $filename; // Define path in public folder
            $file->move(public_path('graveyards'), $filename); // Move file to public/employees
            $graveyard->graveyard_image = $file_path; // Assuming you want to save the public path
            $graveyard->save();
        }
        
        return redirect()->route('panel.graveyards.index')->with('success', 'Graveyard created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Graveyard $graveyard){
        //
        $graveyard->load('block_details.deceased_details');
        $number_of_block_available = $graveyard->block_details->where('status', 'available')->count();
        //dd($graveyard);
        return view('graveyards.graveyard', compact('graveyard', 'number_of_block_available'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Graveyard $graveyard)
    {
        //
        return view('graveyards.edit', compact('graveyard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Graveyard $graveyard)
    {
        //
        $request->validate([
            'graveyard_name' => 'required',
            'block_numbers' => 'required',
        ]);
        $graveyard->update($request->only([
            'graveyard_name',
            'block_numbers'
        ]));
        return redirect()->route('panel.graveyards.index')->with('success', 'Graveyard updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
