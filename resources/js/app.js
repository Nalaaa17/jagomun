import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Cek jika kita sedang berada di halaman admin dashboard
if (window.location.pathname.includes('/admin/dashboard')) {

    console.log('Echo is listening for new registrations...');

    // Dengarkan di channel 'registrations' untuk event 'NewRegistrationCreated'
    window.Echo.channel('registrations')
        .listen('NewRegistrationCreated', (e) => {
            console.log('New registration received!', e);

            // Aksi yang dilakukan: beri notifikasi dan refresh halaman
            alert('Ada pendaftar baru! Halaman akan dimuat ulang untuk menampilkan data terbaru.');
            window.location.reload();
        });
}
