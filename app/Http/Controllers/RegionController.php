<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $region = Region::all();
        return view('admin.regions.index', [
            'region' => $region
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|string',
            'kab_kota' => 'required|string',
        ]);

        $region = Region::create([
            'lokasi' => $request->lokasi,
            'kab_kota' => $request->kab_kota,
        ]);

        return redirect()->route('listRegions')->with('success', 'Daerah berhasil dibuat');
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
        $region = Region::findOrFail($id);
        return view('admin.regions.edit', [
            'region' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input data
        $validateData = $request->validate([
            'lokasi' => 'required|string',
            'kab_kota' => 'required|string',
        ]);

        $region = Region::findOrFail($id);

        // Update data region
        $region->update([
            'lokasi' => $request->lokasi,
            'kab_kota' => $request->kab_kota
        ]);

        // Redirect to index
        return redirect()->route('listRegions')->with('success', 'Daerah Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        // Hapus bidang (soft delete)
        $region->delete();

        return redirect()->route('listRegions')->with('success', 'Daerah Berhasil Dihapus');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
        $trashedRegions = Region::onlyTrashed()->get();
        return view('admin.regions.trash', [
            'trashedRegions' => $trashedRegions
        ]);
    }

    /**
     * Restore the specified trashed resource.
     */
    public function restore(string $id)
    {
        $region = Region::onlyTrashed()->findOrFail($id);
        $region->restore();

        return redirect()->route('listRegions')->with('success', 'Daerah Berhasil Dipulihkan');
    }

    /**
     * Permanently remove the specified trashed resource from storage.
     */
    public function forceDelete(string $id)
    {
        $region = Region::onlyTrashed()->findOrFail($id);

        // Hapus bidang secara permanen
        $region->forceDelete();

        return redirect()->route('listRegions')->with('success', 'Daerah Berhasil Dihapus Secara Permanen');
    }
}
