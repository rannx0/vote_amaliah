<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of candidates.
     */
    public function index()
    {
        // Ambil semua kandidat dengan ketua dan wakil
        $candidates = Candidate::with(['ketua', 'wakil'])->get();
        $users = User::all();

        return view('admin.candidate.index', compact('candidates', 'users'));
    }

    /**
     * Show the form for creating a new candidate.
     */
    public function create()
    {
        // Ambil semua user untuk ketua dan wakil
        $users = User::all();

        return view('candidates.create', compact('users'));
    }

    /**
     * Store a newly created candidate in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'ketua_id' => 'required|exists:users,id',
            'wakil_id' => 'nullable|exists:users,id',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/candidates', 'public');
        }

        // Simpan data kandidat
        Candidate::create([
            'name' => $request->input('name'),
            'ketua_id' => $request->input('ketua_id'),
            'wakil_id' => $request->input('wakil_id'),
            'visi' => $request->input('visi'),
            'misi' => $request->input('misi'),
            'image' => $imagePath,
        ]);

        return redirect()->route('candidate.index')->with('success', 'Candidate created successfully.');
    }

    /**
     * Show the form for editing the specified candidate.
     */
    public function edit(Candidate $candidate)
    {
        // Ambil semua user untuk ketua dan wakil
        $users = User::all();

        return view('candidates.edit', compact('candidate', 'users'));
    }

    /**
     * Update the specified candidate in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'ketua_id' => 'required|exists:users,id',
            'wakil_id' => 'nullable|exists:users,id',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar bersifat opsional
        ]);

        // Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($candidate->image) {
                Storage::disk('public')->delete($candidate->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images/candidates', 'public');
            $candidate->image = $imagePath;
        }

        // Update data kandidat tanpa mengubah gambar jika tidak ada file baru
        $candidate->update([
            'name' => $request->input('name'),
            'ketua_id' => $request->input('ketua_id'),
            'wakil_id' => $request->input('wakil_id'),
            'visi' => $request->input('visi'),
            'misi' => $request->input('misi'),
            // Gambar hanya di-update jika ada gambar baru
            'image' => $candidate->image,
        ]);

        return redirect()->route('candidate.index')->with('success', 'Candidate updated successfully.');
    }


    /**
     * Remove the specified candidate from storage.
     */
    public function destroy($id)
    {
        // Temukan kandidat berdasarkan ID
        $candidate = Candidate::findOrFail($id);

        // Hapus gambar jika ada
        if ($candidate->image) {
            Storage::disk('public')->delete($candidate->image);
        }

        // Hapus data kandidat
        $candidate->delete();

        return redirect()->route('candidate.index')->with('success', 'Candidate deleted successfully.');
    }


    /**
     * Show the specified candidate details.
     */
    public function show(Candidate $candidate)
    {
        return view('candidates.show', compact('candidate'));
    }
}
