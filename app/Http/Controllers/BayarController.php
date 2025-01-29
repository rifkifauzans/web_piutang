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
        $invoice = Invoice::with('compensation') // Load kompensasi terkait
        ->where('contract_id', $contractId)
        ->get();
        
        return view('admin.payments.index', [
            'contract' => $contract,
            'payment' => $payment,
            'invoice' => $invoice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        $invoice = Invoice::with('compensation') // Load kompensasi terkait
        ->where('contract_id', $contractId)
        ->get();

        return view('user.createBayar', [
            'contract' => $contract,
            'invoice' => $invoice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $contractId)
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
    public function edit(string $contractId, $id)
    {
        // Find the contract and invoice based on the given IDs
        $contract = Contracts::findOrFail($contractId);
        $payment = Payment::findOrFail($id);

        return view('admin.payments.edit', [
            'contract' => $contract,
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $contractId, $id)
    {
        // Validate the input
        $request->validate([
            'status' => 'required|string',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => $request->status,
        ]);

        return redirect()->route('listPayments', ['contractId' => $contractId])->with('success', 'Status Pembayaran berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
