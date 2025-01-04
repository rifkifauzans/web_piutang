<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Partners;
use App\Models\User;
use App\Models\Fields;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ContractPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan partner_id dari pengguna yang sedang login
        $partnerId = auth()->user()->partner_id;
    
        // Ambil kontrak berdasarkan partner_id
        $contract = Contracts::where('partner_id', Auth::id())->get();
    
        return view('user.index', compact('contract'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the contract along with related partner and field data
        $contract = Contracts::with('partner', 'field')->findOrFail($id);
        
        // Return the view with the contract data
        return view('user.detailContract', compact('contract'));
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
