<?php

namespace App\Exports;

use App\Models\DelegationRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil semua data pendaftaran beserta relasi delegasinya
        return DelegationRegistration::with('delegates')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Ini adalah judul kolom di file Excel Anda
        return [
            'ID Registrasi',
            'Tipe Registrasi',
            'Tipe Delegasi/Observer',
            'Nama Institusi',
            'Nama Kontak/Delegasi',
            'Email',
            'Telepon',
            'Domisili/Kewarganegaraan',
            'Paket',
            'Butuh Akomodasi',
            'Metode Kehadiran',
            'Tanggal Daftar',
            'Terverifikasi',
        ];
    }

    /**
     * @var DelegationRegistration $registration
     */
    public function map($registration): array
    {
        // Memetakan setiap record ke baris-baris Excel
        $rows = [];

        if ($registration->registering_as == 'Delegation' && $registration->delegates->isNotEmpty()) {
            // Jika ini adalah pendaftaran delegasi, buat satu baris untuk setiap anggota
            foreach ($registration->delegates as $delegate) {
                $rows[] = [
                    $registration->id,
                    $registration->registering_as,
                    $registration->delegate_type,
                    $registration->institution_name,
                    $delegate->full_name, // Nama anggota delegasi
                    $delegate->email,
                    $delegate->phone,
                    $delegate->nationality,
                    $delegate->package_type,
                    $delegate->do_you_need_accommodation ? 'Ya' : 'Tidak',
                    $delegate->attendance_type,
                    $registration->created_at->format('Y-m-d H:i:s'),
                    $registration->is_verified ? 'Ya' : 'Tidak',
                ];
            }
        } else {
            // Jika ini pendaftaran individual atau observer
            $rows[] = [
                $registration->id,
                $registration->registering_as,
                $registration->delegate_type,
                $registration->institution_name,
                $registration->full_name, // Nama pendaftar utama
                $registration->email,
                $registration->phone,
                $registration->nationality,
                $registration->package_type,
                $registration->do_you_need_accommodation ? 'Ya' : 'Tidak',
                $registration->attendance_type,
                $registration->created_at->format('Y-m-d H:i:s'),
                $registration->is_verified ? 'Ya' : 'Tidak',
            ];
        }

        return $rows;
    }
}
