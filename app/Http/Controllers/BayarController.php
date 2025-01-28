<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        $payment = Payment::where('contract_id', $contractId)->get();
        $invoice = Invoice::where('contract_id', $contractId)->get();
 
        return view('admin.payments.index', [
            'contract' => $contract,
            'payment' => $payment,
            'invoice' => $invoice
        ]);
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
