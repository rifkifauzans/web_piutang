<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partners;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partners::all();
        return view('admin.partners.index', [
            'partners' => $partners 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'profile_partner' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'partner_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'userType' => 'required|string',
            'npwp' => 'required|string',
            'pic_name' => 'required|string',
            'address' => 'required|string'
        ]);

        $profile_partner = $request->file('profile_partner');
        $profile_partner->storeAs('public/partners', $profile_partner->hashName());

        $user = User::create([
            'name' => 'Partner',
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'userType' => 'partner'
        ]);

        Partners::create([
            'profile_partner' => $profile_partner->hashName(),
            'partner_name' => $request->partner_name,
            'npwp' => $request->npwp,
            'pic_name' => $request->pic_name,
            'address' => $request->address,
            'user_id' => $user->id
        ]);

        //redirect to index
        return redirect(route('listPartners'))->with('success', 'Mitra Berhasil Ditambahkan');
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
        $partners = Partners::findOrFail($id);
        return view('admin.partners.edit', [
            'partners' => $partners
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $partners = Partners::with('user')->findOrFail($id);
        $validateData = $request->validate([
            'profile_partner' => 'image|mimes:jpeg,jpg,png|max:2048',
            'partner_name' => 'required|string',
            'npwp' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$partners->user_id,
            'pic_name' => 'required|string',
            'address' => 'required|string',
        ]);
        
        $partners = Partners::findOrFail($id);

        //cek apabila gambar akan di upload
        if ($request->hasFile('profile_partner')) {
            // Upload gambar baru
            $profile_partner = $request->file('profile_partner');
            $profile_partner->storeAs('public/partners', $profile_partner->hashName());

            // Hapus gambar lama jika ada
            if ($partners->profile_partner) {
                Storage::delete('public/partners/' . $partners->profile_partner);
            }

            // Update artikel dengan gambar baru
            $partners->profile_partner = $profile_partner->hashName();
        }

        // Update data partner
        $partners->update([
            'partner_name' => $request->partner_name,
            'npwp' => $request->npwp,
            'pic_name' => $request->pic_name,
            'address' => $request->address,
            'profile_partner' => $partners->profile_partner
        ]);

        // Update user data
        $user = $partners->user;
        $user->email = $request->email;
        $user->save();

        // Redirect ke daftar mitra
        return redirect()->route('listPartners')->with('success', 'Mitra Berhasil Diperbarui');
    }

    public function destroy(string $id)
    {
        $partner = Partners::findOrFail($id);
        $partner->delete();
        return redirect()->route('listPartners')->with('success', 'Mitra Berhasil Dihapus');
    }

    /**
     * Display a listing of the trashed partners.
     */
    public function trash()
    {
        $trashedPartners = Partners::onlyTrashed()->with('user')->get();
        return view('admin.partners.trash', [
            'trashedPartners' => $trashedPartners
        ]);
    }

    /**
     * Restore the specified partner from trash.
     */
    public function restore(string $id)
    {
        $partner = Partners::onlyTrashed()->findOrFail($id);
        $partner->restore();

        if ($partner->user) {
            $partner->user->restore();
        }

        return redirect()->route('listPartners')->with('success', 'Mitra Berhasil Dipulihkan');
    }

    /**
     * Permanently delete the specified partner from storage.
     */
    public function forceDelete(string $id)
    {
        $partner = Partners::onlyTrashed()->findOrFail($id);
        Storage::delete('public/partners/' . $partner->profile_partner);
        $partner->forceDelete();
        return redirect()->route('listPartners')->with('success', 'Mitra Berhasil Dihapus Permanen');
    }
}
