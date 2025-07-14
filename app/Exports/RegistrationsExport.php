<?php

namespace App\Exports;

use App\Models\DelegationRegistration;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationsExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        $registrations = DelegationRegistration::with('delegates')->get();

        $rows = [];

        foreach ($registrations as $registration) {
            // Jika ini adalah pendaftaran delegasi dan memiliki anggota
            if ($registration->registering_as == 'Delegation' && $registration->delegates->isNotEmpty()) {
                foreach ($registration->delegates as $delegate) {
                    $rows[] = [
                        // --- Kolom yang sudah ada ---
                        $registration->id,
                        $registration->registering_as,
                        $registration->delegate_type,
                        $registration->institution_name,
                        $delegate->full_name, // Mengambil nama dari anggota delegasi
                        $delegate->email,     // Mengambil email dari anggota delegasi
                        $delegate->phone,     // Mengambil telepon dari anggota delegasi
                        $delegate->nationality, // Mengambil kebangsaan dari anggota delegasi
                        $delegate->package_type,
                        $delegate->do_you_need_accommodation ? 'Ya' : 'Tidak',
                        $delegate->attendance_type,

                        // --- Kolom Baru (diambil dari data registrasi utama) ---
                        $registration->payment_proof_path,
                        $registration->social_media_proof_path,
                        $registration->council_preference_1,
                        $registration->country_preference_1_1,
                        $registration->country_preference_1_2,
                        $registration->reason_for_first_country_preference_1,
                        $registration->reason_for_second_country_preference_1,
                        $registration->council_preference_2,
                        $registration->country_preference_2_1,
                        $registration->country_preference_2_2,
                        $registration->reason_for_first_country_preference_2,
                        $registration->reason_for_second_country_preference_2,
                        $registration->council_preference_3,
                        $registration->country_preference_3_1,
                        $registration->country_preference_3_2,
                        $registration->reason_for_first_country_preference_3,
                        $registration->reason_for_second_country_preference_3,

                        // --- Kolom Penutup ---
                        $registration->created_at->format('Y-m-d H:i:s'),
                        $registration->is_verified ? 'Ya' : 'Tidak',
                    ];
                }
            } else {
                // Jika ini adalah pendaftaran individu atau observer
                $rows[] = [
                    // --- Kolom yang sudah ada ---
                    $registration->id,
                    $registration->registering_as,
                    $registration->delegate_type,
                    $registration->institution_name,
                    $registration->full_name, // Mengambil dari data registrasi utama
                    $registration->email,     // Mengambil dari data registrasi utama
                    $registration->phone,     // Mengambil dari data registrasi utama
                    $registration->nationality, // Mengambil dari data registrasi utama
                    $registration->package_type,
                    $registration->do_you_need_accommodation ? 'Ya' : 'Tidak',
                    $registration->attendance_type,

                    // --- Kolom Baru ---
                    $registration->payment_proof_path,
                    $registration->social_media_proof_path,
                    $registration->council_preference_1,
                    $registration->country_preference_1_1,
                    $registration->country_preference_1_2,
                    $registration->reason_for_first_country_preference_1,
                    $registration->reason_for_second_country_preference_1,
                    $registration->council_preference_2,
                    $registration->country_preference_2_1,
                    $registration->country_preference_2_2,
                    $registration->reason_for_first_country_preference_2,
                    $registration->reason_for_second_country_preference_2,
                    $registration->council_preference_3,
                    $registration->country_preference_3_1,
                    $registration->country_preference_3_2,
                    $registration->reason_for_first_country_preference_3,
                    $registration->reason_for_second_country_preference_3,

                    // --- Kolom Penutup ---
                    $registration->created_at->format('Y-m-d H:i:s'),
                    $registration->is_verified ? 'Ya' : 'Tidak',
                ];
            }
        }

        return $rows;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            // --- Header yang sudah ada ---
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

            // --- Header Baru ---
            'Link Bukti Pembayaran',
            'Link Bukti Follow Sosmed',
            'Preferensi Dewan 1',
            'Preferensi Negara 1.1',
            'Preferensi Negara 1.2',
            'Alasan Preferensi Negara 1.1',
            'Alasan Preferensi Negara 1.2',
            'Preferensi Dewan 2',
            'Preferensi Negara 2.1',
            'Preferensi Negara 2.2',
            'Alasan Preferensi Negara 2.1',
            'Alasan Preferensi Negara 2.2',
            'Preferensi Dewan 3',
            'Preferensi Negara 3.1',
            'Preferensi Negara 3.2',
            'Alasan Preferensi Negara 3.1',
            'Alasan Preferensi Negara 3.2',

            // --- Header Penutup ---
            'Tanggal Daftar',
            'Terverifikasi',
        ];
    }
}
