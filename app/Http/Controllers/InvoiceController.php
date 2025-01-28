<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Invoice;
use App\Models\Compensation;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        $invoice = Invoice::with('compensation')->where('contract_id', $contractId)->get();
        $kompensasi = Compensation::where('contract_id', $contractId)->get();
 
        return view('admin.invoices.index', [
            'contract' => $contract,
            'invoice' => $invoice,
            'kompensasi' => $kompensasi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        $kompensasi = Compensation::where('contract_id', $contractId)->get();

        // Mengambil tahun dari kompensasi yang tersedia
        $years = $kompensasi->pluck('tahun')->unique();

        return view('admin.invoices.create', [
            'contract' => $contract,
            'kompensasi' => $kompensasi,
            'years' => $years
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $contractId)
    {
        // Validasi input
        $request->validate([
            'tgl_terbit' => 'required|date',
            'tahun' => 'required|integer',
        ]);

        // Mendapatkan kompensasi yang sesuai dengan tahun yang dipilih
        $kompensasi = Compensation::where('contract_id', $contractId)
            ->where('tahun', $request->tahun)
            ->first();

        // Jika kompensasi ditemukan
        if ($kompensasi) {
            $totalTagihan = $kompensasi->total; // Ambil total tagihan dari kompensasi
            $dendaPerHari = $kompensasi->denda_per_hari; // Denda per hari dari kompensasi

            // Membuat invoice baru
            $invoice = new Invoice();
            $invoice->compensation_id = $kompensasi->id;
            $invoice->contract_id = $contractId;
            $invoice->tgl_terbit = $request->tgl_terbit;
            $invoice->status = 'draft'; // Status default adalah draft
            $invoice->status_sp = 'None'; // Status SP default
            $invoice->total_tagihan = $totalTagihan;
            $invoice->sisa_tagihan = $totalTagihan; // Sisa tagihan di awal sama dengan total
            $invoice->jml_bayar = 0; // Awal belum ada pembayaran
            $invoice->jml_denda = 0; // Denda awal 0
            $invoice->save();

            return redirect()->route('listInvoices', $contractId)
                ->with('success', 'Invoice berhasil dibuat!');
        }

        return back()->withErrors(['tahun' => 'Data kompensasi untuk tahun tersebut tidak ditemukan.']);
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
        $invoice = Invoice::findOrFail($id);

        // Get the compensation data for the contract
        $kompensasi = Compensation::where('contract_id', $contractId)->get();

        // Get the years for the compensation
        $years = $kompensasi->pluck('tahun')->unique();

        return view('admin.invoices.edit', [
            'contract' => $contract,
            'invoice' => $invoice,
            'kompensasi' => $kompensasi,
            'years' => $years
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $contractId, $id)
    {
        // Validate the input
        $request->validate([
            'tgl_terbit' => 'required|date',
            'tahun' => 'required|integer',
            'status' => 'required|string',
            'status_sp' => 'required|string',
            'jml_bayar' => 'required|numeric|min:0',
        ]);

        // Find the invoice by ID
        $invoice = Invoice::findOrFail($id);

        // Get the corresponding compensation for the selected year
        $kompensasi = Compensation::where('contract_id', $contractId)
            ->where('tahun', $request->tahun)
            ->first();

        if ($kompensasi) {
            // Mengambil jumlah hari terlambat (dari input admin)
            $jmlDendaHari = $request->jml_denda;

            // Hitung denda berdasarkan hari terlambat * (1/1000 dari total tagihan)
            $jmlDenda = $jmlDendaHari * (1 / 1000); // Menghitung jumlah denda berdasarkan hari terlambat

            // Sisa tagihan adalah sisa tagihan sebelumnya - pembayaran baru + denda
            $sisaTagihan = $invoice->sisa_tagihan - $request->jml_bayar + $jmlDenda;

            // Pastikan sisa tagihan tidak negatif
            if ($sisaTagihan < 0) {
                $sisaTagihan = 0; // Jangan biarkan sisa tagihan menjadi negatif

                // Update data invoice dengan nilai baru
                $invoice->sisa_tagihan = $sisaTagihan;
            }

            // Update data invoice
            $invoice->tgl_terbit = $request->tgl_terbit;
            $invoice->status = $request->status;
            $invoice->status_sp = $request->status_sp;
            $invoice->jml_bayar = $request->jml_bayar;
            $invoice->jml_denda = $request->jml_denda; 
            $invoice->save();

            return redirect()->route('listInvoices', ['contractId' => $contractId])
                ->with('success', 'Invoice berhasil diperbarui!');
        }

        return back()->withErrors(['tahun' => 'Data kompensasi untuk tahun tersebut tidak ditemukan.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $contractId, $id)
    {
        $invoice = Invoice::where('contract_id', $contractId)
                                ->where('id', $id)
                                ->firstOrFail();
        $invoice->delete();

        return redirect()->route('listInvoices', ['contractId' => $contractId])
                     ->with('success', 'Invoice berhasil dihapus');
    }

    public function trash(string $contractId)
    {
        $trashedInvoices = Invoice::onlyTrashed()
                                        ->where('contract_id', $contractId)
                                        ->get();

        return view('admin.invoices.trash', [
            'trashedInvoices' => $trashedInvoices,
            'contractId' => $contractId
        ]);
    }

    /**
     * Restore the specified partner from trash.
     */
    public function restore(string $contractId, $id)
    {
        $invoice = Invoice::onlyTrashed()
                                ->where('contract_id', $contractId)
                                ->where('id', $id)
                                ->firstOrFail();
        $invoice->restore();

        return redirect()->route('listInvoices', ['contractId' => $contractId])
                     ->with('success', 'Invoice Sharing berhasil dipulihkan');
    }

    /**
     * Permanently delete the specified partner from storage.
     */
    public function forceDelete(string $contractId, $id)
    {
        $invoice = Invoice::onlyTrashed()
                                ->where('contract_id', $contractId)
                                ->where('id', $id)
                                ->firstOrFail();
        $invoice->forceDelete();

        return redirect()->route('trashInvoices', ['contractId' => $contractId])
                     ->with('success', 'Invoice Sharing berhasil dihapus permanen');
    }
}
