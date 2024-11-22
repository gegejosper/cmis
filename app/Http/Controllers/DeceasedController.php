<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deceased;
use App\Models\Graveyard;
use App\Models\Block;
use App\Models\BlockDeceased;
use App\Models\Visitor;
class DeceasedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $deceaseds = Deceased::orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->with('block_details', 'graveyard_details')
                    ->get();
        return view('deceaseds.deceaseds', compact('deceaseds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $graveyards = Graveyard::get();
        return view('deceaseds.create', compact('graveyards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'block_id' => 'required',
            'graveyard_id' => 'required',
        ]);
        $block = Block::find($request->block_id);
        $block->update(['status' => 'not available']);
        $deceased = Deceased::create($request->all());
        //return response()->json($deceased);
        session()->flash('success', 'Deceased successfully added to block');
        return response()->json([
            'success' => true,
            'message' => 'Deceased successfully added to block',
            'redirect_url' => route('panel.graveyards.show', $request->graveyard_id),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deceased $deceased)
    {
        $visitors = Visitor::where('deceased_id', $deceased->id)->orderBy('id', 'desc')->get();
        return view('deceaseds.deceased', compact('deceased', 'visitors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deceased $deceased)
    {
        //
        return view('deceaseds.edit', compact('deceased'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deceased $deceased)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
        ]);
        $deceased->update($request->only([
            'first_name',
            'last_name', 
            'dob'
        ]));
        return redirect()->route('panel.deceaseds.index')->with('success', 'Deceased updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deceased $deceased){
        //
        $block_id = $deceased->block_id;
        $delete_visitors = Visitor::where('deceased_id', $deceased->id)->delete();
        $deceased->delete();

        return redirect('/panel/blocks/'.$block_id.'/edit')->with('success', 'Deceased deleted successfully.');
    }
}
