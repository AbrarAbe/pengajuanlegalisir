// main scripts
(function ($) {

    "use strict";

    var fullHeight = function () {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });

    };
    fullHeight();

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

})(jQuery);

document.addEventListener("DOMContentLoaded", function () {
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function (callback) {
            fetch('https://ipinfo.io?token=7b70fe5064d574')
                .then(response => response.json())
                .then(data => callback(data.country))
                .catch(() => callback("id"));
        },
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.7.3/build/js/utils.js", // for formatting/validation etc.
        autoPlaceholder: "polite"
    });

    document.querySelector("#phone").addEventListener("blur", function () {
        var iti = window.intlTelInputGlobals.getInstance(this);
        if (iti.isValidNumber()) {
            var number = iti.getNumber(); // Dapatkan nomor dalam format internasional
            console.log("Nomor valid:", number);
        } else {
            console.log("Nomor tidak valid");
        }
    });

    window.intlTelInput(input, {
        initialCountry: "id", // Default Indonesia
        preferredCountries: ['us', 'gb', 'id'], // Negara yang sering digunakan
        separateDialCode: true, // Pisahkan kode negara dari nomor telepon
        // Opsi lainnya...
    });
});

/* // Form harga total
function updateTotal() {
    const legalisirIjazah = parseInt(document.getElementById('jumlah_legalisir_ijazah').value) || 0;
    const legalisirTranskrip = parseInt(document.getElementById('jumlah_legalisir_transkrip').value) || 0;
    const ekspedisi = document.querySelector('input[name="ekspedisi"]:checked');
    var ekspedisiHarga = 0;

    const hargaIjazah = 3000; // Harga per legalisir ijazah
    const hargaTranskrip = 3000; // Harga per legalisir transkrip

    if (ekspedisi) {
        ekspedisiHarga = parseInt(ekspedisi.getAttribute('data-harga'));
    }

    var totalHarga = (legalisirIjazah * hargaIjazah) + (legalisirTranskrip * hargaTranskrip); // Harga per legalisir, misalnya Rp. 10.000
    if (!document.getElementById('ambil').checked) {
        totalHarga += ekspedisiHarga;
    }

    document.getElementById('total_harga').innerText = totalHarga.toLocaleString('id-ID');
    document.getElementById('total_harga_input').value = totalHarga;
    document.getElementById('ekspedisi_harga_input').value = ekspedisiHarga;
}*/

document.addEventListener('DOMContentLoaded', function () {
    metodePengiriman();
});

// Form harga total
function updateTotal() {
    const legalisirIjazah = parseInt(document.getElementById('jumlah_legalisir_ijazah').value) || 0;
    const legalisirTranskrip = parseInt(document.getElementById('jumlah_legalisir_transkrip').value) || 0;

    const hargaIjazah = 5000; // Harga per legalisir ijazah
    const hargaTranskrip = 5000; // Harga per legalisir transkrip

    var totalHarga = (legalisirIjazah * hargaIjazah) + (legalisirTranskrip * hargaTranskrip); // Harga per legalisir, misalnya Rp. 10.000

    document.getElementById('total_harga').innerText = totalHarga.toLocaleString('id-ID');
    document.getElementById('total_harga_input').value = totalHarga;
}

// Cek angka negatif di input jumlah legalisir
function checkNegative(input) {
    if (input.value < 0) {
        input.value = 1;
    }
}

// Button script
function metodePengiriman() {
    var metodeCOD = document.getElementById('kirim').checked;
    var nomorRekening = document.getElementById('nomorRekening');
    var buktiPembayaran = document.getElementById('buktiPembayaran');
    var alamatPengiriman = document.getElementById('alamatPengiriman');
    var warningPengiriman = document.getElementById('warningPengiriman');
    var hint = document.getElementById('hint');

    if (metodeCOD) {
        nomorRekening.style.display = 'none';
        buktiPembayaran.style.display = 'none';
        alamatPengiriman.style.display = 'block';
        warningPengiriman.style.display = 'block';
        hint.style.display = 'block';
    } else {
        nomorRekening.style.display = 'block';
        buktiPembayaran.style.display = 'block';
        alamatPengiriman.style.display = 'none';
        warningPengiriman.style.display = 'none';
        hint.style.display = 'none';
    }
}

// Button show password
function showPass() {
    // Toggle the type attribute using getAttribute() and setAttribute()
    const password = document.getElementById('password');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the eye slash icon
    const toggleIcon = document.getElementById('toggleIcon');
    if (type === 'password') {
        toggleIcon.classList.remove('nf-fa-eye');
        toggleIcon.classList.add('nf-fa-eye_slash');
    } else {
        toggleIcon.classList.remove('nf-fa-eye_slash');
        toggleIcon.classList.add('nf-fa-eye');
    }
}

// Delete
function confirmDelete(id_pengajuan) {
    if (confirm("Apakah Anda yakin ingin menghapus pengajuan ini?")) {
        window.location.href = '../proses/delete_pengajuan.php?id_pengajuan=' + id_pengajuan;
    }
}

// Logout
function confirmLogout() {
    if (confirm("Apakah Anda yakin ingin logout?")) {
        window.location.href = '../proses/logout.php';
    }
}

// Script datatable

// Table pagination
new DataTable('#table-p', {
    autoWidth: false,
    stateSave: true,
    responsive: true,
    colReorder: true,
    layout: {
        topStart: {
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        }
    }
});

// Table scroll
$(document).ready(function () {

    var table = $('#table-s').DataTable({
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh'
    });
});

$(document).ready(function () {

    var table = $('#table-s2').DataTable({
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh'
    });
});

$(document).ready(function () {

    var table = $('#table-s3').DataTable({
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh'
    });
});

$(document).ready(function () {

    var table = $('#table-s4').DataTable({
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh'
    });
});

$(document).ready(function () {

    var table = $('#table-s5').DataTable({
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh',
        dom: '<"top"f>rt<"bottom"Blip>',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
});

// Table scroll + pagination
$(document).ready(function () {

    var table = $('#table-sp').DataTable({
        lengthChange: true,
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        layout: {
            topStart: {
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            }
        }
    });
});


// Table scroll print
$(document).ready(function () {
    var table = $('#table-a').DataTable({
        autoWidth: false,
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh',
        dom: '<"top"f>rt<"bottom"Blip>',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
});

$(function () {
    $('#example1').DataTable({
        responsive: true, lengthChange: false, autoWidth: false,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        stateSave: true,
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        scrollCollapse: true,
        scrollY: '50vh',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    });
});