<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Tentang;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * ==========================
         * SUPERADMIN USER
         * ==========================
         */
        User::updateOrCreate(
            ['email' => 'superadmin@yayasan.com'],
            [
                'name' => 'Superadmin Yayasan',
                'role' => 'superadmin', // ✅ Ini kuncinya!
                'password' => Hash::make('password123'),
            ]
        );

        /**
         * ==========================
         * ADMIN USER
         * ==========================
         */
        User::updateOrCreate(
            ['email' => 'admin@yayasan.com'],
            [
                'name' => 'Admin Yayasan',
                'role' => 'admin', // ✅ Tambahkan role eksplisit
                'password' => Hash::make('password123'),
            ]
        );

        /**
         * ==========================
         * ARTIKEL
         * ==========================
         */
        $artikelData = [
            [
                'judul' => 'Penerimaan Siswa Baru Tahun Ajaran 2024/2025',
                'isi' => '<p>Yayasan Pendidikan Al-Ihsan membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025...</p>',
                'status' => 'published',
                'thumbnail' => 'artikel/dummy1.jpg',
            ],
            [
                'judul' => 'Kegiatan Outing Class TK Al-Ihsan ke Kebun Binatang',
                'isi' => '<p>Siswa-siswi TK Al-Ihsan mengikuti kegiatan outing class ke Kebun Binatang Ragunan...</p>',
                'status' => 'published',
                'thumbnail' => 'artikel/dummy2.jpg',
            ],
            [
                'judul' => 'SD Al-Ihsan Raih Juara 1 Lomba Matematika',
                'isi' => '<p>Prestasi membanggakan kembali diraih SD Al-Ihsan...</p>',
                'status' => 'published',
                'thumbnail' => 'artikel/dummy3.jpg',
            ],
        ];

        foreach ($artikelData as $data) {
            Artikel::updateOrCreate(
                ['slug' => Str::slug($data['judul'])],
                array_merge($data, [
                    'slug' => Str::slug($data['judul']),
                ])
            );
        }

        /**
         * ==========================
         * GALERI
         * ==========================
         */
        $galeriData = [
            [
                'kategori' => 'TK',
                'judul' => 'Kegiatan Pembelajaran TK',
                'foto' => 'galeri/tk1.jpg',
                'deskripsi' => 'Suasana pembelajaran yang menyenangkan',
            ],
            [
                'kategori' => 'TK',
                'judul' => 'Outing Class TK',
                'foto' => 'galeri/tk2.jpg',
                'deskripsi' => 'Kunjungan ke tempat edukatif',
            ],
            [
                'kategori' => 'SD',
                'judul' => 'Upacara Bendera SD',
                'foto' => 'galeri/sd1.jpg',
                'deskripsi' => 'Upacara rutin setiap hari Senin',
            ],
            [
                'kategori' => 'SD',
                'judul' => 'Lomba Sains SD',
                'foto' => 'galeri/sd2.jpg',
                'deskripsi' => 'Kompetisi sains tingkat nasional',
            ],
        ];

        foreach ($galeriData as $data) {
            Galeri::updateOrCreate(
                ['judul' => $data['judul']],
                $data
            );
        }

        /**
         * ==========================
         * PRESTASI
         * ==========================
         */
        $prestasiData = [
            [
                'judul' => 'Juara 1 Lomba Mewarnai Tingkat Kecamatan',
                'sekolah' => 'TK',
                'tahun' => 2024,
                'foto' => 'prestasi/tk1.jpg',
                'deskripsi' => 'Siswa TK Al-Ihsan berhasil meraih juara 1 lomba mewarnai',
            ],
            [
                'judul' => 'Juara 1 Olimpiade Matematika Tingkat Kota',
                'sekolah' => 'SD',
                'tahun' => 2024,
                'foto' => 'prestasi/sd1.jpg',
                'deskripsi' => 'Tim olimpiade matematika SD Al-Ihsan meraih prestasi gemilang',
            ],
            [
                'judul' => 'Juara 2 Lomba Hafalan Al-Quran',
                'sekolah' => 'SD',
                'tahun' => 2023,
                'foto' => 'prestasi/sd2.jpg',
                'deskripsi' => 'Siswa SD Al-Ihsan meraih juara 2 lomba tahfidz Quran',
            ],
        ];

        foreach ($prestasiData as $data) {
            Prestasi::updateOrCreate(
                ['judul' => $data['judul']],
                $data
            );
        }

        /**
         * ==========================
         * TENTANG
         * ==========================
         */
        Tentang::updateOrCreate(
            ['judul' => 'Tentang Yayasan Pendidikan Al-Ihsan'],
            [
                'isi' => '<h2>Sejarah Yayasan</h2><p>Yayasan Pendidikan Al-Ihsan didirikan pada tahun 2010...</p>',
                'foto' => 'tentang/yayasan.jpg',
            ]
        );

        $this->command->info('✅ Seeding completed successfully!');
        $this->command->info('📧 Superadmin Email: superadmin@yayasan.com');
        $this->command->info('🔑 Superadmin Password: password123');
        $this->command->info('📧 Admin Email: admin@yayasan.com');
        $this->command->info('🔑 Admin Password: password123');
    }
}