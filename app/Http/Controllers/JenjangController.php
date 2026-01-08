<?php
// app/Http\Controllers\JenjangController.php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Tentang;
use App\Models\Staff;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    /**
     * Halaman Jenjang TK
     */
    public function tk()
    {
        // Filter data untuk TK
        $galeriTK = Galeri::where('kategori', 'TK')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $prestasiTK = Prestasi::where('sekolah', 'TK')
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Ambil data tentang umum
        $tentangTK = Tentang::first();

        // AMBIL STAFF KHUSUS UNTUK TK:
        // 1. Pimpinan yayasan (tampil di semua jenjang)
        // 2. Kepala sekolah TK (jika ada di database)
        // 3. Guru dengan kategori "guru" yang mengajar TK
        $staffTK = Staff::where(function ($query) {
            // Pimpinan yayasan (tampil di semua jenjang)
            $query->where('kategori', 'pimpinan')
                // Kepala sekolah TK (jika ada di database dengan jabatan mengandung "TK")
                ->orWhere(function ($q) {
                    $q->where('kategori', 'kepsek')
                        ->where('jabatan', 'like', '%TK%');
                })
                // Guru yang mengajar TK (berdasarkan jabatan)
                ->orWhere(function ($q) {
                    $q->where('kategori', 'guru')
                        ->where(function ($subQ) {
                            $subQ->where('jabatan', 'like', '%TK%')
                                ->orWhere('jabatan', 'like', '%Taman Kanak%')
                                ->orWhere('jabatan', 'like', '%PAUD%');
                        });
                });
        })
            ->orderBy('urutan', 'asc')
            ->get();

        // Data umum untuk jenjang TK
        $dataTK = [
            'nama_sekolah' => 'TK IT Baitul Insan',
            'alamat' => 'Jl. Raya Kurungan, Nyawa, Pal.12, Gg Sholeha, Pesawaran, Lampung 35154',
            'telepon' => '0821-8280-2679',
            'email' => 'tk.baitulinsan@gmail.com',
            'kepala_sekolah' => 'Ibu Rahma Sari, S.Pd.',
            'akreditasi' => 'A',
            'tahun_berdiri' => '2015',
            'visi' => '"Menjadi TK Islam terpadu yang membentuk karakter profetik sejak dini"',
            'misi' => [
                'Melaksanakan pendidikan berbasis nilai-nilai Islam untuk anak usia dini',
                'Mengembangkan potensi anak secara holistik melalui metode Asah, Asih, Asuh',
                'Menciptakan lingkungan belajar yang aman, nyaman, dan menyenangkan',
                'Membangun kerjasama dengan orang tua dalam mendidik anak',
            ],
            'program_unggulan' => [
                'Tahfidz Quran Juz 30',
                'Fun Learning dengan Metode Sentra',
                'Outdoor Activity & Field Trip',
                'Pengembangan Motorik Halus & Kasar',
                'Pembiasaan Sholat & Adab Islami',
            ],
            'fasilitas' => [
                'Ruang Kelas Ber-AC',
                'Area Bermain Outdoor & Indoor',
                'Perpustakaan Anak',
                'Laboratorium Komputer Mini',
                'Ruang UKS & Poliklinik',
                'Tempat Wudhu Anak',
                'Kantin Sehat',
            ],
            'jam_belajar' => 'Senin - Jumat, 07.30 - 11.30 WIB',
            'ekstrakurikuler' => [
                'Mewarnai & Menggambar',
                'Tari Kreasi Anak',
                'Tahfidz Quran',
                'Fun Cooking',
                'Berenang',
            ],
            'prestasi' => $prestasiTK,
            'galeri' => $galeriTK,
            'staff' => $staffTK,
            'tentang' => $tentangTK,
        ];

        return view('pages.jenjang.tk', $dataTK);
    }

    /**
     * Halaman Jenjang SD
     */
    public function sd()
    {
        // Ambil data untuk SD
        $galeriSD = Galeri::where('kategori', 'SD')->orderBy('created_at', 'desc')->take(8)->get();
        $prestasiSD = Prestasi::where('sekolah', 'SD')->orderBy('tahun', 'desc')->orderBy('created_at', 'desc')->take(6)->get();

        // Ambil data tentang umum (mungkin berisi deskripsi profil jika disimpan di sana)
        $tentangSD = Tentang::first(); // atau method lain sesuai kebutuhan

        // Ambil data staff untuk SD - Gunakan pendekatan yang dioptimalkan
        // Ambil semua staff yang kategorinya 'pimpinan', 'kepsek', atau 'guru'
        $staffRelevant = Staff::whereIn('kategori', ['pimpinan', 'kepsek', 'guru'])
            ->orderBy('urutan', 'asc')
            ->get();

        // Filter di PHP berdasarkan jabatan untuk SD
        $kepalaYayasanSD = $staffRelevant->where('kategori', 'pimpinan');
        $kepalaSekolahSD = $staffRelevant->filter(function ($item) {
            return $item->kategori === 'kepsek' && stripos($item->jabatan, 'SD') !== false;
        });
        $guruSD = $staffRelevant->filter(function ($item) {
            if ($item->kategori === 'guru') {
                if (stripos($item->jabatan, 'SD') !== false || stripos($item->jabatan, 'Sekolah Dasar') !== false) {
                    return true;
                }
                if (stripos($item->jabatan, 'TK') === false && stripos($item->jabatan, 'Taman Kanak') === false) {
                    return true;
                }
            }
            return false;
        });

        // Gabungkan hasil filter ke dalam satu koleksi $staff
        $staffSD = $kepalaYayasanSD->concat($kepalaSekolahSD)->concat($guruSD);

        // Data statis untuk SD (termasuk visi, misi, program unggulan, fasilitas, ekstrakurikuler)
        $dataSD = [
            'nama_sekolah' => 'SD IT Baitul Insan',
            'alamat' => 'Jl. Raya Kurungan, Nyawa, Pal.12, Gg Sholeha, Pesawaran, Lampung 35154',
            'telepon' => '0821-8280-2679',
            'email' => 'sdit.baitulinsan@gmail.com',
            'kepala_sekolah' => 'Bapak Ahmad Fauzi, M.Pd.',
            'akreditasi' => 'A',
            'tahun_berdiri' => '2018',
            'jam_belajar' => 'Senin - Jumat, 07.30 - 15.30 WIB',
            'ekstrakurikuler' => [ // Tambahkan ke array data
                'Tahfidz Quran',
                'Pramuka',
                'English Club',
                'Robotik',
                'Seni Tari',
                'Bulutangkis',
            ],
            'kurikulum' => [ // Tambahkan ke array data
                'Kurikulum Merdeka',
                'Penguatan Pendidikan Karakter (PPK)',
                'Asesmen Kompetensi Minimum (AKM)',
                'Surat Edaran Dirjen GTK tentang Pembelajaran',
            ],
            'fasilitas' => [ // Tambahkan ke array data
                'Kelas Ber-AC',
                'Laboratorium Sains',
                'Perpustakaan Digital',
                'Lapangan Olahraga',
                'Area Bermain',
                'Kantin Sehat',
                'Tempat Wudhu',
                'Masjid Kecil',
            ],
            'program_unggulan' => [ // Tambahkan ke array data
                'Tahfidz Quran 3 Juz (Juz 29, 30, 1)',
                'Full Day School dengan Sistem Moving Class',
                'Program Bilingual (Indonesia-English)',
                'IT Based Learning',
                'Project Based Learning',
                'Outbound & Leadership Training',
            ],
            'prestasi' => $prestasiSD,
            'galeri' => $galeriSD,
            // Kirim data staff yang sudah digabungkan dan dikelompokkan
            'staff' => $staffSD, // Kirim koleksi gabungan sebagai $staff
            'kepalaYayasan' => $kepalaYayasanSD,
            'kepalaSekolah' => $kepalaSekolahSD,
            'guru' => $guruSD,
            'tentang' => $tentangSD,
            // Tambahkan visi dan misi ke array data yang dikirim
            'visi' => '"Menjadi SD Islam terpadu yang unggul dalam IMTAQ dan IPTEK"',
            'misi' => [
                'Menyelenggarakan pendidikan Islam terpadu yang berkualitas',
                'Mengembangkan potensi akademik dan non-akademik siswa',
                'Menanamkan nilai-nilai karakter profetik dalam kehidupan sehari-hari',
                'Membangun kemitraan dengan orang tua dan masyarakat',
            ],
            // Variabel untuk mengecek jika ada staff (opsional, bisa digunakan di view)
            'totalStaff' => $staffSD->count(),
        ];

        return view('pages.jenjang.sd', $dataSD);
    }
}