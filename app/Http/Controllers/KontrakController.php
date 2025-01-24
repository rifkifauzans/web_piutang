<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Partners;
use App\Models\User;
use App\Models\Fields;
use App\Models\Region;
use App\Models\Employees;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contracts::with(['partner', 'field', 'employee', 'region'])->get();
            return view('admin.contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partners::all();
        $fields = Fields::all();
        $employees = Employees::all();
        $region = Region::all();
        return view('admin.contracts.create', [
            'partners' => $partners,
            'fields' => $fields,
            'employees' => $employees,
            'region' => $region
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,user_id',
            'field_id' => 'required|exists:fields,id',
            'employee_id' => 'required|exists:employees,id',
            'region_id' => 'required|exists:region,id',
            'awal_janji' => 'required|date',
            'akhir_janji' => 'required|date|after_or_equal:awal_janji',
            'nilai' => 'required|integer|min:0',
            'no_pks' => 'required|url|max:255',
            'luas' => 'required|integer|min:1',
            'ket' => 'nullable|string|max:500',
        ]);

        $awal_janji = Carbon::parse($request->awal_janji);
        $akhir_janji = Carbon::parse($request->akhir_janji);
        $jangkaWaktu = $awal_janji->diffInMonths($akhir_janji) / 12;
        $jangkaWaktu = ceil($jangkaWaktu);



        // Menggunakan metode create untuk menyimpan data ke dalam model Contracts
        $contract = Contracts::create([
            'contract_code' => Contracts::generateContractNumber(),
            'partner_id' => $request->partner_id,
            'field_id' => $request->field_id,
            'employee_id' => $request->employee_id,
            'region_id' => $request->region_id,
            'awal_janji' => $request->awal_janji,
            'akhir_janji' => $request->akhir_janji,
            'nilai' => $request->nilai,
            'no_pks' => $request->no_pks,
            'jangka_waktu' => $jangkaWaktu,
            'luas' => $request->luas,
            'ket' => $request->ket,
            'status' => 'baru',
        ]);

        // Mengalihkan ke halaman index dengan pesan sukses
        return redirect()->route('listContracts')->with('success', 'Kontrak berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contract = Contracts::with('partner', 'field', 'employee', 'region')->findOrFail($id);
        return view('admin.contracts.detail', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contracts = Contracts::with(['partner', 'field', 'employee', 'region'])->findOrFail($id);
        $partners = Partners::all();
        $fields = Fields::all();
        $employees = Employees::all();
        $region = Region::all();
        return view('admin.contracts.edit', [
            'contracts' => $contracts,
            'partners' => $partners,
            'fields' => $fields,
            'employees' => $employees,
            'region' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contracts = Contracts::findOrFail($id);

        $request->validate([
            'partner_id' => 'required|exists:partners,user_id',
            'field_id' => 'required|exists:fields,id',
            'employee_id' => 'required|exists:employees,id',
            'region_id' => 'required|exists:region,id',
            'awal_janji' => 'required|date',
            'akhir_janji' => 'required|date|after_or_equal:awal_janji',
            'nilai' => 'required|integer|min:0',
            'no_pks' => 'required|url|max:255',
            'luas' => 'required|integer|min:1',
            'ket' => 'nullable|string|max:500',
            'status' => 'required|string',
        ]);

        $awal_janji = Carbon::parse($request->awal_janji);
        $akhir_janji = Carbon::parse($request->akhir_janji);
        $jangkaWaktu = $awal_janji->diffInMonths($akhir_janji) / 12;
        $jangkaWaktu = ceil($jangkaWaktu);

        $contracts->update([
            'partner_id' => $request->partner_id,
            'field_id' => $request->field_id,
            'employee_id' => $request->employee_id,
            'region_id' => $request->region_id,
            'awal_janji' => $request->awal_janji,
            'akhir_janji' => $request->akhir_janji,
            'nilai' => $request->nilai,
            'no_pks' => $request->no_pks,
            'jangka_waktu' => $jangkaWaktu,
            'luas' => $request->luas,
            'ket' => $request->ket,
            'status' => $request->status,
        ]);

        return redirect()->route('listContracts')->with('success', 'Kontrak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contract = Contracts::findOrFail($id);
        $contract->delete();
        return redirect()->route('listContracts')->with('success', 'Kontrak Berhasil Dihapus');
    }

     /**
     * Display a listing of the trashed partners.
     */
    public function trash()
    {
        $trashedContracts = Contracts::onlyTrashed()->get();
        return view('admin.contracts.trash', [
            'trashedContracts' => $trashedContracts
        ]);
    }

    /**
     * Restore the specified partner from trash.
     */
    public function restore(string $id)
    {
        $contract = Contracts::onlyTrashed()->findOrFail($id);
        $contract->restore();

        return redirect()->route('listContracts')->with('success', 'Kontrak Berhasil Dipulihkan');
    }

    /**
     * Permanently delete the specified partner from storage.
     */
    public function forceDelete(string $id)
    {
        $contract = Contracts::onlyTrashed()->findOrFail($id);
        $contract->forceDelete();
        return redirect()->route('listContracts')->with('success', 'Kontrak Berhasil Dihapus Permanen');
    }
}
