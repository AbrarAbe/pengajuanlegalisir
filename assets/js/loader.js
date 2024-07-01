document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua elemen dengan kelas "preload-link"
    var links = document.querySelectorAll('.preload-link');
    var submitBtn = document.getElementById('submitBtn');
    var preloaderLink = document.getElementById('preloaderLink');
    var preloaderSubmit = document.getElementById('preloaderSubmit');

    // Tambahkan event listener untuk setiap link
    links.forEach(function (link) {
        link.addEventListener('click', function (event) {
            // Tampilkan preloader link
            preloaderLink.classList.add('show-preloader');

            // Jalankan animasi preloader secara asinkron
            setTimeout(function () {
                // Sembunyikan preloader setelah animasi selesai
                preloaderLink.classList.remove('show-preloader');// Sembunyikan preloader setelah selesai
                // Lanjutkan ke halaman tujuan
                window.location.href = link.href;
            }, 1000); // Delay 3 detik (3000ms)

            // Hentikan aksi default link untuk mencegah navigasi langsung
            event.preventDefault();
        });
    });

    // Event listener untuk tombol submit
    submitBtn.addEventListener('click', function (event) {
        // Delay untuk simulasi proses submit
        preloaderSubmit.style.display = 'flex';
        setTimeout(function () {
            preloaderSubmit.style.display = 'none'; // Sembunyikan preloader setelah selesai
            // Lanjutkan dengan submit form
            document.getElementById('loginForm').submit();
        }, 1000); // Delay 3 detik (3000ms)

        // Hentikan aksi default submit untuk mencegah submit langsung
        //event.preventDefault();
    });
});