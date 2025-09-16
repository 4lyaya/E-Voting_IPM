<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Ganti dengan kredensial admin yang sesuai
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.results');
        }

        return back()->with('error', 'Kredensial tidak valid.');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function results()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        $candidates = Candidate::withCount('votes')->get();
        $maxVotes = $candidates->max('votes_count');
        $totalVotes = $candidates->sum('votes_count');

        // Cari kandidat pemenang (votes paling tinggi)
        $winner = $candidates->sortByDesc('votes_count')->first();

        // Dapatkan index/urutan pemenang
        $index = $candidates->search(fn($c) => $c->id === $winner->id) + 1;

        // Hitung persentase
        $candidates->each(function ($candidate) use ($totalVotes) {
            $candidate->percentage = $totalVotes > 0
                ? round(($candidate->votes_count / $totalVotes) * 100, 2)
                : 0;
        });

        return view('admin.results', compact('candidates', 'totalVotes', 'maxVotes', 'winner', 'index'));
    }
}