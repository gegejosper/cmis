<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deceased;
use App\Models\Graveyard;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    //
    public function index() {
        // $user = User::find(1); // Example user
        // $user->assignRole('admin');
        $graveyards = Graveyard::with('block_details')->get();
        $visitors = Visitor::with('deceased_details')->orderBy('id', 'desc')->take(10)->get();
        return view('dashboard', compact('graveyards', 'visitors'));
    }

    public function assignRoleToUser(Request $request, User $user)
    {
        //dd($user);
         // Get the role from the query string
         $role = $request->query('role'); // Example: ?role=admin

         // Check if the role is valid
         if (!$role || !in_array($role, ['admin', 'staff', 'user'])) {
             return response()->json(['error' => "Invalid role provided."], 400);
         }
 
         // Assign the role to the user
         $user->assignRole($role);
 
         return response()->json(['success' => "Role '{$role}' assigned to user."]);
    }

    public function reports(Request $request){
        // $deceaseds = Deceased::orderBy('id', 'asc')
        //             ->with('block_details', 'graveyard_details')
        //             ->get();
        // return view('reports', compact('deceaseds'));
        // Initialize the query
        $query = Deceased::orderBy('id', 'asc')
        ->with('block_details', 'graveyard_details');

        // Filter by month if provided
        if ($request->has('month') && $request->month) {
        $query->whereMonth('dob', $request->month);
        }

        // Filter by year if provided
        if ($request->has('year') && $request->year) {
        $query->whereYear('dob', $request->year);
        }

        // Get the filtered results
        $deceaseds = $query->get();

        // Return the view with the deceaseds and old input for filtering
        return view('reports', compact('deceaseds'));
    }

    public function search_deceaseds(Request $req){
        $searchTerm = '%'.$req->search_query.'%';
        $keyword = $req->search_query;
        $deceaseds = Deceased::where(function($query) use ($searchTerm){
                            $query->where('first_name','LIKE', $searchTerm)
                            ->orWhere('last_name','LIKE', $searchTerm);
                        })->orderBy('last_name', 'asc')
                        ->orderBy('first_name', 'asc')
                        ->with('block_details', 'graveyard_details')
                        ->get();
       //dd($students);
        return view('deceaseds.deceaseds', compact('deceaseds', 'keyword'));
    }
}
