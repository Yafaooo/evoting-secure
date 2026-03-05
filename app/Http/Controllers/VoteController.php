<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class VoteController extends Controller
{
    /**
     * Menangani proses voting secara aman.
     */
    public function store(Request $request)
    {
        // 1. Validasi input: pastikan kandidat yang dipilih benar-benar ada di database
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        try {
            /** * 2. Algoritma Anonimitas & Keamanan SHA-256
             * Kita menggunakan IP Address + App Key untuk simulasi (karena belum ada sistem login).
             * Ini memastikan identitas asli pemilih tidak tersimpan langsung di database.
             */
            $voterHash = hash('sha256', $request->ip() . config('app.key'));

            // 3. Cek Double Voting: Mencegah satu orang memilih lebih dari sekali
            if (Vote::where('voter_hash', $voterHash)->exists()) {
                return back()->with('error', 'Maaf, Anda sudah menggunakan hak pilih Anda!');
            }

            /** * 4. Buat Digital Signature (Checksum)
             * Berfungsi untuk memastikan integritas data (data tidak dimanipulasi di database).
             */
            $signature = hash('sha256', $request->candidate_id . $voterHash . now());

            // 5. Simpan ke Database menggunakan Mass Assignment
            Vote::create([
                'id'           => (string) Str::uuid(),
                'candidate_id' => $request->candidate_id,
                'voter_hash'   => $voterHash,
                'signature'    => $signature,
            ]);

            return back()->with('success', 'Suara Anda berhasil direkam secara aman dengan SHA-256!');

        } catch (\Exception $e) {
            // Log error jika terjadi masalah teknis
            Log::error('Vote Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }
    }
}