<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deceased;
use App\Models\Graveyard;
use App\Models\Visitor;

class StaffController extends Controller
{
    //
    public function index()
    {

        $graveyards = Graveyard::with('block_details')->get();
        $visitors = Visitor::with('deceased_details')->orderBy('id', 'desc')->take(10)->get();
        return view('dashboard', compact('graveyards', 'visitors'));
    }

}
