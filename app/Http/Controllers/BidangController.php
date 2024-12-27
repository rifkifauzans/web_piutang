<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fields;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Fields::all();
        return view('admin.fields.index', [
            'fields' => $fields
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'field_name' => 'required|string',
        ]);

        $field = Fields::create([
            'field_name' => $request->field_name,
        ]);

        return redirect()->route('listFields')->with('success', 'Bidang berhasil dibuat');
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
        $fields = Fields::findOrFail($id);
        return view('admin.fields.edit', [
            'fields' => $fields
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input data
        $validateData = $request->validate([
            'field_name' => 'required|string',
        ]);

        $field = Fields::findOrFail($id);

        // Update data employee
        $field->update([
            'field_name' => $request->field_name
        ]);

        // Redirect to index
        return redirect()->route('listFields')->with('success', 'Bidang Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $field = Fields::findOrFail($id);
        // Hapus bidang (soft delete)
        $field->delete();

        return redirect()->route('listFields')->with('success', 'Bidang Berhasil Dihapus');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
        $trashedFields = Fields::onlyTrashed()->get();
        return view('admin.fields.trash', [
            'trashedFields' => $trashedFields
        ]);
    }

    /**
     * Restore the specified trashed resource.
     */
    public function restore(string $id)
    {
        $field = Fields::onlyTrashed()->findOrFail($id);
        $field->restore();

        return redirect()->route('listFields')->with('success', 'Bidang Berhasil Dipulihkan');
    }

    /**
     * Permanently remove the specified trashed resource from storage.
     */
    public function forceDelete(string $id)
    {
        $field = Fields::onlyTrashed()->findOrFail($id);

        // Hapus bidang secara permanen
        $field->forceDelete();

        return redirect()->route('listFields')->with('success', 'Bidang Berhasil Dihapus Secara Permanen');
    }
}
