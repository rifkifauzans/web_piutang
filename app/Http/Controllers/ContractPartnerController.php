<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Partners;
use App\Models\User;
use App\Models\Fields;
use App\Models\Region;
use App\Models\Employees;
use App\Models\Payment;
use App\Models\Invoice;
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
    public function create($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        $payment = Payment::where('contract_id', $contractId)->get();
        $invoice = Invoice::with('compensation') // Load kompensasi terkait
        ->where('contract_id', $contractId)
        ->get();

        return view('user.createBayar', [
            'contract' => $contract,
            'invoice' => $invoice,
            'payment' => $payment
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $contractId)
    {
        $request->validate([
            'tahun' => 'required',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tgl_bayar' => 'required|date',
            'ket' => 'nullable|string',
        ]);
    
        // Simpan gambar
        $bukti_bayar = $request->file('bukti_bayar');
        $bukti_bayarPath = $bukti_bayar->storeAs('public/payments', $bukti_bayar->hashName());
    
        // Ambil invoice berdasarkan tahun yang dipilih
        $invoice = Invoice::whereHas('compensation', function ($query) use ($request) {
            $query->where('tahun', $request->tahun);
        })->where('contract_id', $contractId)->first();
    
        if (!$invoice) {
            return back()->with('error', 'Invoice tidak ditemukan!');
        }
    
        // Simpan pembayaran
        Payment::create([
            'contract_id' => $contractId,
            'invoice_id' => $invoice->id,
            'bukti_bayar' => $bukti_bayar->hashName(),
            'tgl_bayar' => $request->tgl_bayar,
            'ket' => $request->ket,
            'status' => 'Belum Lunas',
        ]);
    
        return redirect()->route('detail', $contractId)
            ->with('success', 'Pembayaran berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the contract along with related partner and field data
        $contract = Contracts::with('partner', 'field', 'region', 'employee', 'invoices')->findOrFail($id);
        
        // Fetch the payment data
        $payment = Payment::where('contract_id', $id)->get();
        // Return the view with the contract data
        return view('user.detailContract', compact('contract', 'payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $contractId, $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, $contractId)
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
