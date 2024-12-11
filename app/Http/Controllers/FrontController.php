<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deceased;
use App\Models\Graveyard;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    public function index(){

        return view('welcome');
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function locations() {
        $graveyards = Graveyard::with('block_details')->get();
        return view('locations', compact('graveyards'));
    }
    public function view_locations($graveyard_id) {
        $graveyard = Graveyard::with('block_details.deceased_details')->findOrFail($graveyard_id);
        //dd($graveyard);
        return view('location', compact('graveyard'));
    }
    public function search() {
        return view('search');
    }
    public function gallery() {
        return view('gallery');
    }
    public function search_result(Request $req) {
        $searchTerm = '%'.$req->q.'%';
        $keyword = $req->q;
        $deceaseds = Deceased::where(function($query) use ($searchTerm){
                            $query->where('first_name','LIKE', $searchTerm)
                            ->orWhere('last_name','LIKE', $searchTerm)
                            ->orWhere('middle_name','LIKE', $searchTerm);
                        })->orderBy('last_name', 'asc')
                        ->orderBy('first_name', 'asc')
                        ->with('block_details', 'graveyard_details')->get();
        return view('search', compact('deceaseds'));
    }
}
