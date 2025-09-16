<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            ['nis' => '2025000001', 'name' => 'Budi Santoso'],
            ['nis' => '2025000002', 'name' => 'Siti Rahayu'],
            ['nis' => '2025000003', 'name' => 'Ahmad Fauzi'],
            ['nis' => '2025000004', 'name' => 'Dewi Lestari'],
            ['nis' => '2025000005', 'name' => 'Rudi Hermawan'],
            ['nis' => '2025000006', 'name' => 'Maya Sari'],
            ['nis' => '2025000007', 'name' => 'Joko Prasetyo'],
            ['nis' => '2025000008', 'name' => 'Rina Wulandari'],
            ['nis' => '2025000009', 'name' => 'Hendra Setiawan'],
            ['nis' => '2025000010', 'name' => 'Lia Agustina'],
            // ['nis' => '2025000011', 'name' => 'Doni Saputra'],
            // ['nis' => '2025000012', 'name' => 'Indah Permata'],
            // ['nis' => '2025000013', 'name' => 'Arif Kurniawan'],
            // ['nis' => '2025000014', 'name' => 'Sari Melati'],
            // ['nis' => '2025000015', 'name' => 'Bayu Prasetya'],
            // ['nis' => '2025000016', 'name' => 'Nina Kartika'],
            // ['nis' => '2025000017', 'name' => 'Fajar Hidayat'],
            // ['nis' => '2025000018', 'name' => 'Ratna Dewi'],
            // ['nis' => '2025000019', 'name' => 'Andi Wijaya'],
            // ['nis' => '2025000020', 'name' => 'Putri Anggraini'],
            // ['nis' => '2025000021', 'name' => 'Yoga Pratama'],
            // ['nis' => '2025000022', 'name' => 'Dian Maharani'],
            // ['nis' => '2025000023', 'name' => 'Rizky Setiawan'],
            // ['nis' => '2025000024', 'name' => 'Ayu Lestari'],
            // ['nis' => '2025000025', 'name' => 'Tono Susilo'],
            // ['nis' => '2025000026', 'name' => 'Mega Wati'],
            // ['nis' => '2025000027', 'name' => 'Agus Salim'],
            // ['nis' => '2025000028', 'name' => 'Rosa Melinda'],
            // ['nis' => '2025000029', 'name' => 'Ilham Saputra'],
            // ['nis' => '2025000030', 'name' => 'Yuni Rahmawati'],
            // ['nis' => '2025000031', 'name' => 'Eko Santoso'],
            // ['nis' => '2025000032', 'name' => 'Fitri Handayani'],
            // ['nis' => '2025000033', 'name' => 'Galih Pradana'],
            // ['nis' => '2025000034', 'name' => 'Nur Aisyah'],
            // ['nis' => '2025000035', 'name' => 'Kiki Ramadhani'],
            // ['nis' => '2025000036', 'name' => 'Bagus Permadi'],
            // ['nis' => '2025000037', 'name' => 'Rani Oktaviani'],
            // ['nis' => '2025000038', 'name' => 'Dedi Firmansyah'],
            // ['nis' => '2025000039', 'name' => 'Salsa Amelia'],
            // ['nis' => '2025000040', 'name' => 'Bambang Susanto'],
            // ['nis' => '2025000041', 'name' => 'Citra Ayu'],
            // ['nis' => '2025000042', 'name' => 'Feriansyah Putra'],
            // ['nis' => '2025000043', 'name' => 'Hana Pratiwi'],
            // ['nis' => '2025000044', 'name' => 'Iqbal Ramadhan'],
            // ['nis' => '2025000045', 'name' => 'Lestari Puspita'],
            // ['nis' => '2025000046', 'name' => 'Rio Saputra'],
            // ['nis' => '2025000047', 'name' => 'Syifa Nuraini'],
            // ['nis' => '2025000048', 'name' => 'Tegar Maulana'],
            // ['nis' => '2025000049', 'name' => 'Winda Safitri'],
            // ['nis' => '2025000050', 'name' => 'Zaki Prasetya'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
