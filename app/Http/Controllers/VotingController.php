<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function index()
    {
        return view('voting.index');
    }

    public function verifyNis(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:students,nis'
        ]);

        $student = Student::where('nis', $request->nis)->first();

        if ($student->has_voted) {
            return redirect()->back()->with('error', 'NIS ini sudah melakukan voting sebelumnya.');
        }

        session(['verified_nis' => $request->nis, 'student_id' => $student->id]);

        $candidates = Candidate::all();
        return view('voting.vote', compact('candidates'));
    }

    public function vote(Request $request)
    {
        if (!session()->has('verified_nis')) {
            return redirect()->route('voting.index')->with('error', 'Silakan masukkan NIS terlebih dahulu.');
        }

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        $student = Student::find(session('student_id'));

        if ($student->has_voted) {
            return redirect()->route('voting.index')->with('error', 'Anda sudah melakukan voting sebelumnya.');
        }

        // Simpan vote
        Vote::create([
            'student_id' => $student->id,
            'candidate_id' => $request->candidate_id
        ]);

        // Update status student
        $student->update(['has_voted' => true]);

        // Update jumlah vote kandidat
        $candidate = Candidate::find($request->candidate_id);
        $candidate->increment('votes_count');

        // Hapus session
        session()->forget(['verified_nis', 'student_id']);

        return redirect()->route('voting.index')->with('success', 'Terima kasih! Voting Anda telah direkam.');
    }
}