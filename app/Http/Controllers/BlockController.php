<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Block;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'block_name' => 'required',
        ]);
        $block = Block::create($request->all());
        //dd($request->all());
        session()->flash('success', 'Block successfully added');
        return response()->json([
            'success' => true,
            'message' => 'Block successfully added',
            'redirect_url' => route('panel.graveyards.show', $request->graveyard_id),
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
    public function edit(Block $block)
    {
        //
        $block->load('deceased_details');
        return view('blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block)
    {
        //
        $request->validate([
            'block_name' => 'required',
            'status' => 'required'
        ]);

        $block->update($request->only([
            'block_name',
            'status'
        ]));
        return redirect('/panel/blocks/'.$block->id.'/edit')->with('success', 'Decease deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
