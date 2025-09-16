<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('name')->paginate(10);

        $votedCount = Student::where('has_voted', true)->count();

        return view('admin.students.index', compact('students', 'votedCount'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:students,nis|digits_between:4,20',
            'name' => 'required|string|max:255',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.digits_between' => 'NIS harus berupa angka antara 4-20 digit.',
            'name.required' => 'Nama siswa wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            Student::create([
                'nis' => $request->nis,
                'name' => $request->name,
                'has_voted' => false,
            ]);

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|digits_between:4,20|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.digits_between' => 'NIS harus berupa angka antara 4-20 digit.',
            'name.required' => 'Nama siswa wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $student->update([
                'nis' => $request->nis,
                'name' => $request->name,
            ]);

            return redirect()->route('students.index')
                ->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            // Cek apakah siswa sudah voting
            if ($student->has_voted) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus siswa yang sudah melakukan voting.');
            }

            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}