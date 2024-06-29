// Form harga total
function updateTotal() {
    const legalisirIjazah = parseInt(document.getElementById('jumlah_legalisir_ijazah').value) || 0;
    const legalisirTranskrip = parseInt(document.getElementById('jumlah_legalisir_transkrip').value) || 0;
    const ekspedisi = document.querySelector('input[name="ekspedisi"]:checked');
    const ekspedisiHarga = ekspedisi ? parseInt(ekspedisi.getAttribute('data-harga')) : 0;

    const hargaIjazah = 3000; // Harga per legalisir ijazah
    const hargaTranskrip = 5000; // Harga per legalisir transkrip

    const totalHarga = (legalisirIjazah * hargaIjazah) + (legalisirTranskrip * hargaTranskrip) + ekspedisiHarga;

    document.getElementById('total_harga').innerText = totalHarga;
    document.getElementById('total_harga_input').value = totalHarga; // Update hidden input value
    document.getElementById('ekspedisi_harga_input').value = ekspedisiHarga; // Set ekspedisi harga value
}

// Button script
// Button metode pengiriman
function toggleEkspedisi() {
    const metode = document.querySelector('input[name="metode_pengambilan"]:checked').value;
    const ekspedisiDiv = document.getElementById('ekspedisi_article');
    ekspedisiDiv.style.display = metode === 'kirim ke alamat' ? 'block' : 'none';
}

// Button show password
$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("nf nf-fa-eye_slash");
            $('#show_hide_password i').removeClass("nf nf-fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("nf nf-fa-eye_slash");
            $('#show_hide_password i').addClass("nf nf-fa-eye");
        }
    });
});

function apala() {
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

function toggle_tbDivalidasi() {
    var a = document.getElementById('tbDivalidasi');
    if (a.style.display === 'none') {
        a.style.display = 'block';
    } else {
        a.style.display = 'none';
    }
}

function toggle_tbDitolak() {
    var b = document.getElementById('tbDitolak');
    if (b.style.display === 'none') {
        b.style.display = 'block';
    } else {
        b.style.display = 'none';
    }
}

// Script datatable

// Table pagination
new DataTable('#table-p', {
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
        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh'
    });
});

$(document).ready(function () {

    var table = $('#tables5').DataTable({
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

// Table scroll print
$(document).ready(function () {
    var table = $('#table-a').DataTable({
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