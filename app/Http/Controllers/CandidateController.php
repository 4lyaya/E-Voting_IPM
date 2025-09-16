<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::withCount('votes')->orderBy('name')->paginate(6);
        $totalVotes = \App\Models\Vote::count();

        return view('admin.candidates.index', compact('candidates', 'totalVotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama kandidat wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'vision.required' => 'Visi wajib diisi.',
            'mission.required' => 'Misi wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $data = [
                'name' => $request->name,
                'vision' => $request->vision,
                'mission' => $request->mission,
                'votes_count' => 0,
            ];

            // Upload photo jika ada
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('candidates', 'public');
                $data['photo'] = $photoPath;
            }

            Candidate::create($data);

            return redirect()->route('candidates.index')
                ->with('success', 'Kandidat berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama kandidat wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'vision.required' => 'Visi wajib diisi.',
            'mission.required' => 'Misi wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $data = [
                'name' => $request->name,
                'vision' => $request->vision,
                'mission' => $request->mission,
            ];

            // Upload photo baru jika ada
            if ($request->hasFile('photo')) {
                // Hapus photo lama jika ada
                if ($candidate->photo) {
                    Storage::disk('public')->delete($candidate->photo);
                }

                $photoPath = $request->file('photo')->store('candidates', 'public');
                $data['photo'] = $photoPath;
            }

            $candidate->update($data);

            return redirect()->route('candidates.index')
                ->with('success', 'Data kandidat berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        try {
            // Cek apakah kandidat sudah memiliki suara
            if ($candidate->votes_count > 0) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus kandidat yang sudah memiliki suara.');
            }

            // Hapus photo jika ada
            if ($candidate->photo) {
                Storage::disk('public')->delete($candidate->photo);
            }

            $candidate->delete();

            return redirect()->route('candidates.index')
                ->with('success', 'Kandidat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}