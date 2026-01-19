<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppdb;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PpdbController extends Controller
{
    /**
     * Menampilkan form pendaftaran lengkap (PUBLIC)
     */
    public function index()
    {
        // Ambil data prefill dari session jika ada
        $prefillData = session('prefill_data', []);

        // Hapus session setelah digunakan
        session()->forget('prefill_data');

        return view('daftar-sekarang', compact('prefillData'));
    }

    /**
     * Store data pendaftaran dari form lengkap (PUBLIC)
     */
    public function store(Request $request)
    {
        Log::info('=== PPDB STORE METHOD CALLED ===');
        Log::info('Request Data:', $request->except(['foto_anak', 'foto_kk', 'foto_akte', 'foto_ktp_ayah', 'foto_ktp_ibu']));

        // Mulai database transaction
        DB::beginTransaction();

        try {
            // Validasi data
            $validator = Validator::make($request->all(), [
                // Data Calon Siswa
                'nama' => 'required|string|max:255',
                'nik' => 'required|digits:16|unique:ppdbs,nik',
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'umur' => 'required|integer|min:1|max:20',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'anak_ke' => 'required|integer|min:1',
                'dari_bersaudara' => 'required|integer|min:1',
                'asal_sekolah' => 'required|string|max:255',
                'alamat' => 'required|string',

                // Data Orang Tua
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'no_hp_ayah' => 'required|string|max:15',
                'no_hp_ibu' => 'required|string|max:15',
                'pendapatan' => 'required|string|max:50',
                'alamat_orang_tua' => 'required|string',

                // File uploads
                'foto_anak' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'foto_akte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'foto_ktp_ayah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'foto_ktp_ibu' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'nik.digits' => 'NIK harus 16 digit angka',
                'nik.unique' => 'NIK ini sudah terdaftar',
                'foto_anak.required' => 'Pas foto anak wajib diupload',
                'foto_anak.mimes' => 'Pas foto harus format JPG, JPEG, atau PNG',
                'foto_anak.max' => 'Pas foto maksimal 2MB',
                'foto_kk.required' => 'Foto KK wajib diupload',
                'foto_kk.mimes' => 'Foto KK harus format JPG, JPEG, PNG, atau PDF',
                'no_hp_ayah.max' => 'Nomor HP ayah maksimal 15 digit',
                'no_hp_ibu.max' => 'Nomor HP ibu maksimal 15 digit',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Log::error('❌ Validation errors: ' . implode(', ', $errors));

                // Untuk AJAX request
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Validasi gagal'
                    ], 422);
                }

                // Untuk regular request
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terdapat kesalahan dalam pengisian data. Silakan periksa kembali.');
            }

            $validated = $validator->validated();
            Log::info('✅ Validation passed! Fields: ' . implode(', ', array_keys($validated)));

            // Cek duplikat NIK (double check)
            $existing = Ppdb::where('nik', $validated['nik'])->first();
            if ($existing) {
                Log::warning('⚠️ Duplicate NIK: ' . $validated['nik']);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'NIK ini sudah terdaftar. Silakan gunakan NIK lain atau hubungi admin.');
            }

            // Generate nomor pendaftaran
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $random = strtoupper(Str::random(4));
            $noPendaftaran = "PPDB-{$year}{$month}{$day}-{$random}";
            Log::info('🎫 Generated No Pendaftaran: ' . $noPendaftaran);

            // Siapkan data untuk disimpan
            $dataToSave = [
                'no_pendaftaran' => $noPendaftaran,
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'umur' => $validated['umur'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'anak_ke' => $validated['anak_ke'],
                'dari_bersaudara' => $validated['dari_bersaudara'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'alamat' => $validated['alamat'],
                'nama_ayah' => $validated['nama_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'no_hp_ayah' => $validated['no_hp_ayah'],
                'no_hp_ibu' => $validated['no_hp_ibu'],
                'pendapatan' => $validated['pendapatan'],
                'alamat_orang_tua' => $validated['alamat_orang_tua'],
                'status' => 'menunggu',
                'sudah_dihubungi' => false,
            ];

            // Upload file ke storage
            $uploadPath = 'dokumen/ppdb/' . date('Y/m/d');

            // Pastikan folder ada
            if (!Storage::disk('public')->exists($uploadPath)) {
                Storage::disk('public')->makeDirectory($uploadPath, 0755, true);
                Log::info('📁 Created directory: ' . $uploadPath);
            }

            $fileFields = ['foto_anak', 'foto_kk', 'foto_akte', 'foto_ktp_ayah', 'foto_ktp_ibu'];
            $uploadedFiles = [];

            foreach ($fileFields as $field) {
                if (isset($validated[$field]) && $validated[$field] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $validated[$field];
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    // Generate unique filename
                    $filename = Str::slug($validated['nama']) . '_' . $field . '_' . time() . '.' . $extension;
                    $path = $file->storeAs($uploadPath, $filename, 'public');

                    $dataToSave[$field] = $path;
                    $uploadedFiles[$field] = $path;
                    Log::info("✅ File uploaded - {$field}: {$path} (original: {$originalName})");
                } else {
                    Log::error("❌ File {$field} is missing or invalid!");
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "File {$field} tidak valid. Silakan upload ulang.");
                }
            }

            Log::info('💾 Attempting to save to database...');

            // Simpan ke database
            $ppdb = Ppdb::create($dataToSave);
            DB::commit();

            Log::info('🎉 DATA SAVED SUCCESSFULLY!');
            Log::info('🆔 ID: ' . $ppdb->id);
            Log::info('📇 No Pendaftaran: ' . $ppdb->no_pendaftaran);
            Log::info('👤 Nama: ' . $ppdb->nama);

            // ================================
            // GENERATE WHATSAPP MESSAGE
            // ================================
            $waUrl = $this->generateWhatsAppMessage($ppdb);

            // Simpan data untuk response
            $successData = [
                'no_pendaftaran' => $ppdb->no_pendaftaran,
                'nama' => $ppdb->nama,
                'nik' => $ppdb->nik,
                'tempat_lahir' => $ppdb->tempat_lahir,
                'tanggal_lahir' => $ppdb->tanggal_lahir,
                'umur' => $ppdb->umur,
                'jenis_kelamin' => $ppdb->jenis_kelamin,
                'asal_sekolah' => $ppdb->asal_sekolah,
                'anak_ke' => $ppdb->anak_ke,
                'dari_bersaudara' => $ppdb->dari_bersaudara,
                'nama_ayah' => $ppdb->nama_ayah,
                'nama_ibu' => $ppdb->nama_ibu,
                'no_hp_ayah' => $ppdb->no_hp_ayah,
                'no_hp_ibu' => $ppdb->no_hp_ibu,
                'pendapatan' => $ppdb->pendapatan,
                'alamat' => $ppdb->alamat,
                'alamat_orang_tua' => $ppdb->alamat_orang_tua,
                'wa_url' => $waUrl,
            ];

            // Untuk AJAX request
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran berhasil!',
                    'no_pendaftaran' => $ppdb->no_pendaftaran,
                    'wa_url' => $waUrl,
                    'data' => $successData
                ]);
            }

            // Untuk regular form submission
            return redirect()->route('daftar-sekarang')
                ->with([
                    'success' => 'Pendaftaran berhasil! Nomor pendaftaran Anda: <strong>' . $ppdb->no_pendaftaran . '</strong><br>Silakan simpan nomor ini untuk pengecekan status pendaftaran.',
                    'registration_data' => $successData
                ]);
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('💥 CRITICAL ERROR in store method:');
            Log::error('📝 Message: ' . $e->getMessage());
            Log::error('🗂️ File: ' . $e->getFile());
            Log::error('📍 Line: ' . $e->getLine());
            Log::error('🔍 Trace: ' . $e->getTraceAsString());

            // Untuk AJAX request
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
                    'error_details' => 'File: ' . $e->getFile() . ' Line: ' . $e->getLine()
                ], 500);
            }

            // Untuk regular request
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi admin. Error: ' . $e->getMessage());
        }
    }

    /**
     * Generate WhatsApp message and URL (TANPA EMOJI)
     */
    private function generateWhatsAppMessage(Ppdb $ppdb)
    {
        // Ambil nomor admin dari .env
        $adminWa = env('ADMIN_WA_NUMBER', '082225832575');

        // Format nomor WhatsApp
        $waNumber = $this->formatWhatsAppNumber($adminWa);

        // Format tanggal lahir
        $tanggalLahir = date('d F Y', strtotime($ppdb->tanggal_lahir));

        // Buat pesan WhatsApp TANPA EMOJI — hanya teks & simbol ASCII
        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh\n\n" .
            "Halo Admin PPDB SD IT Baitul Insan,\n\n" .
            "Saya *" . $ppdb->nama_ayah . "* (ayah dari calon siswa *" . $ppdb->nama . "*) " .
            "ingin mengonfirmasi pendaftaran PPDB Tahun Ajaran 2025/2026.\n\n" .
            "----------------------------------------\n\n" .
            "[DATA CALON SISWA]\n" .
            "========================================\n" .
            "- No. Pendaftaran: " . $ppdb->no_pendaftaran . "\n" .
            "- Nama Lengkap: " . $ppdb->nama . "\n" .
            "- NIK: " . $ppdb->nik . "\n" .
            "- TTL: " . $ppdb->tempat_lahir . ", " . $tanggalLahir . "\n" .
            "- Umur: " . $ppdb->umur . " tahun\n" .
            "- Jenis Kelamin: " . $ppdb->jenis_kelamin . "\n" .
            "- Asal Sekolah: " . $ppdb->asal_sekolah . "\n" .
            "- Anak ke: " . $ppdb->anak_ke . " dari " . $ppdb->dari_bersaudara . " bersaudara\n\n" .
            "----------------------------------------\n\n" .
            "[DATA ORANG TUA]\n" .
            "========================================\n" .
            "- Nama Ayah: " . $ppdb->nama_ayah . "\n" .
            "- Nama Ibu: " . $ppdb->nama_ibu . "\n" .
            "- No. HP Ayah: " . $ppdb->no_hp_ayah . "\n" .
            "- No. HP Ibu: " . $ppdb->no_hp_ibu . "\n" .
            "- Penghasilan: " . $ppdb->pendapatan . "\n\n" .
            "----------------------------------------\n\n" .
            "[ALAMAT CALON SISWA]\n" .
            "========================================\n" .
            $ppdb->alamat . "\n\n" .
            "----------------------------------------\n\n" .
            "STATUS PENDAFTARAN: Menunggu verifikasi\n\n" .
            "----------------------------------------\n\n" .
            "[PERMOHONAN KONFIRMASI]:\n" .
            "Mohon admin dapat mengkonfirmasi bahwa data pendaftaran ini telah:\n" .
            "1. Berhasil diterima sistem\n" .
            "2. Sedang dalam proses verifikasi\n" .
            "3. Informasi tahap selanjutnya (tes/wawancara)\n\n" .
            "----------------------------------------\n\n" .
            "Jazakumullah khairan katsiran atas perhatian dan kerjasamanya.\n\n" .
            "Wassalamu'alaikum Warahmatullahi Wabarakatuh,\n\n" .
            "*" . $ppdb->nama_ayah . "*\n" .
            "Orang Tua/Wali dari *" . $ppdb->nama . "*\n\n" .
            "Kontak: " . $ppdb->no_hp_ayah;

        // Encode pesan untuk URL
        $encodedMessage = urlencode($message);

        // Return URL WhatsApp — TANPA SPASI
        return "https://wa.me/{$waNumber}?text={$encodedMessage}";
    }

    /**
     * Format nomor WhatsApp ke format internasional
     */
    private function formatWhatsAppNumber($number)
    {
        // Hapus karakter selain angka
        $number = preg_replace('/[^0-9]/', '', $number);

        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Jika dimulai dengan 8 (tanpa 0), tambahkan 62
        if (substr($number, 0, 1) === '8') {
            $number = '62' . $number;
        }

        return $number;
    }
}
