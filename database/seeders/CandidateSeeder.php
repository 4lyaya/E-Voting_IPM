<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run()
    {
        $candidates = [
            [
                'name' => 'Ahmad Rizki',
                'vision' => 'Mewujudkan OSIS yang aktif, kreatif, dan inovatif dalam setiap kegiatan sekolah',
                'mission' => '1. Meningkatkan kualitas kegiatan ekstrakurikuler. 2. Menjadi jembatan antara siswa dan pihak sekolah. 3. Mengadakan kegiatan yang menunjang pengembangan diri siswa.'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'vision' => 'Menjadikan OSIS sebagai wadah pengembangan potensi siswa yang berkarakter dan berprestasi',
                'mission' => '1. Menyelenggarakan kegiatan yang edukatif dan menghibur. 2. Meningkatkan sarana prasarana untuk mendukung kegiatan siswa. 3. Membangun komunikasi yang harmonis antar seluruh warga sekolah.'
            ],
            [
                'name' => 'Budi Pratama',
                'vision' => 'Menciptakan lingkungan sekolah yang nyaman, kondusif, dan penuh semangat belajar',
                'mission' => '1. Mengoptimalkan peran OSIS dalam setiap kegiatan sekolah. 2. Menjalin kerjasama dengan alumni untuk pengembangan siswa. 3. Meningkatkan kegiatan keagamaan dan sosial.'
            ]
        ];

        foreach ($candidates as $candidate) {
            Candidate::create($candidate);
        }
    }
}