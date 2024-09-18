<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index() {
        // Ambil semua kandidat dari database
        $candidates = Candidate::all();

        // Kirim data kandidat ke view 'vote'
        return view('vote', compact('candidates'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek apakah pengguna sudah memberikan suara
        if (Vote::where('user_id', $user->id)->exists()) {
            Auth::logout();
            return redirect()->route('already_vote');
        }

        // Validasi input
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Simpan vote
        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->input('candidate_id'),
        ]);
        Auth::logout();
        return redirect()->route('end')->with('success', 'Vote berhasil disimpan.');

    }

    public function endindex() 
    {
        return view('end');
    }
}

