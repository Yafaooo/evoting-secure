<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;

class VoteController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        $results = Candidate::withCount('votes')->get();
        return view('voting', compact('candidates', 'results'));
    }

    public function store(Request $request)
    {
        $request->validate(['candidate_id' => 'required|exists:candidates,id']);

        try {
            Vote::create([
                'candidate_id' => $request->candidate_id,
                'voter_hash'   => hash('sha256', time() . rand()), // Nama kolom sesuai phpMyAdmin
                'signature'    => bin2hex(random_bytes(16)),       // Mengisi signature agar tidak NULL
            ]);

            return redirect()->route('home')->with('success', 'VOTE BERHASIL!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Gagal: ' . $e->getMessage()]);
        }
    }
}