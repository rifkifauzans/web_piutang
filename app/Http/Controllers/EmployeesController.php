<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::all();
        return view('admin.employees.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input data
        $validateData = $request->validate([
            'nik' => 'required|string|unique:employees,nik',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'employees_name' => 'required|string',
            'position' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        // Simpan gambar
        $profile_picture = $request->file('profile_picture');
        $profile_picturePath = $profile_picture->storeAs('public/employees', $profile_picture->hashName());

        // Simpan employee
        Employees::create([
            'nik' => $request->nik,
            'profile_picture' => $profile_picture->hashName(),
            'employees_name' => $request->employees_name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        // Redirect to index
        return redirect()->route('listEmployees')->with('success', 'Karyawan Berhasil Ditambahkan');

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
        $employees = Employees::findOrFail($id);
        return view('admin.employees.edit', [
            'employees' => $employees
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input data
        $validateData = $request->validate([
            'nik' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'employees_name' => 'required|string',
            'position' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        $employee = Employees::findOrFail($id);

        // Update gambar jika ada file baru
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama dari storage
            Storage::delete('public/employees/' . $employee->profile_picture);

            // Simpan gambar baru
            $profile_picture = $request->file('profile_picture');
            $profile_picturePath = $profile_picture->storeAs('public/employees', $profile_picture->hashName());

            $employee->profile_picture = $profile_picture->hashName();
        }

        // Update data employee
        $employee->update([
            'nik' => $request->nik,
            'employees_name' => $request->employees_name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        // Redirect to index
        return redirect()->route('listEmployees')->with('success', 'Karyawan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::findOrFail($id);
        // Hapus pegawai (soft delete)
        $employee->delete();

        return redirect()->route('listEmployees')->with('success', 'Karyawan Berhasil Dihapus');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
        $trashedEmployees = Employees::onlyTrashed()->get();
        return view('admin.employees.trash', [
            'trashedEmployees' => $trashedEmployees
        ]);
    }

    /**
     * Restore the specified trashed resource.
     */
    public function restore(string $id)
    {
        $employee = Employees::onlyTrashed()->findOrFail($id);
        $employee->restore();

        return redirect()->route('listEmployees')->with('success', 'Karyawan Berhasil Dipulihkan');
    }

    /**
     * Permanently remove the specified trashed resource from storage.
     */
    public function forceDelete(string $id)
    {
        $employee = Employees::onlyTrashed()->findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($employee->profile_picture) {
            Storage::delete('public/employees/' . $employee->profile_picture);
        }

        // Hapus pegawai secara permanen
        $employee->forceDelete();

        return redirect()->route('listEmployees')->with('success', 'Karyawan Berhasil Dihapus Secara Permanen');
    }
}
