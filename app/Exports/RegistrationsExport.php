<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $registrations;

    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    public function collection()
    {
        return $this->registrations;
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'NIK',
            'Nama Calon Siswa',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Umur',
            'Jenis Kelamin',
            'Anak Ke',
            'Dari Bersaudara',
            'Asal Sekolah',
            'Alamat',
            'Nama Ayah',
            'Nama Ibu',
            'No HP Ayah',
            'No HP Ibu',
            'Penghasilan',
            'Alamat Orang Tua',
            'Status',
            'Sudah Dihubungi',
            'Disetujui Oleh',
            'Disetujui Pada',
            'Catatan Admin',
            'Tanggal Daftar'
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->no_pendaftaran,
            $registration->nik,
            $registration->nama,
            $registration->tempat_lahir,
            $registration->tanggal_lahir_formatted,
            $registration->umur,
            $registration->jenis_kelamin,
            $registration->anak_ke,
            $registration->dari_bersaudara,
            $registration->asal_sekolah,
            $registration->alamat,
            $registration->nama_ayah,
            $registration->nama_ibu,
            $registration->no_hp_ayah,
            $registration->no_hp_ibu,
            $registration->pendapatan,
            $registration->alamat_orang_tua,
            $this->getStatusText($registration->status),
            $registration->sudah_dihubungi ? 'Ya' : 'Tidak',
            $registration->disetujui_oleh,
            $registration->disetujui_pada_formatted ?? '',
            $registration->catatan_admin,
            $registration->created_at->format('d/m/Y H:i')
        ];
    }

    private function getStatusText($status)
    {
        return match ($status) {
            'menunggu' => 'Menunggu',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => $status
        };
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Header row
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0d6efd']
                ]
            ],
            // Alternating row colors
            'A2:W' . ($this->registrations->count() + 1) => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'f8f9fa']
                ]
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, // No Pendaftaran
            'B' => 20, // NIK
            'C' => 25, // Nama
            'D' => 15, // Tempat Lahir
            'E' => 15, // Tanggal Lahir
            'F' => 10, // Umur
            'G' => 15, // Jenis Kelamin
            'H' => 10, // Anak Ke
            'I' => 15, // Dari Bersaudara
            'J' => 20, // Asal Sekolah
            'K' => 30, // Alamat
            'L' => 20, // Nama Ayah
            'M' => 20, // Nama Ibu
            'N' => 15, // No HP Ayah
            'O' => 15, // No HP Ibu
            'P' => 15, // Penghasilan
            'Q' => 30, // Alamat Orang Tua
            'R' => 15, // Status
            'S' => 15, // Sudah Dihubungi
            'T' => 20, // Disetujui Oleh
            'U' => 20, // Disetujui Pada
            'V' => 40, // Catatan Admin
            'W' => 20, // Tanggal Daftar
        ];
    }
}