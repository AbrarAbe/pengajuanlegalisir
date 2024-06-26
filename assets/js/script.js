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

function toggleEkspedisi() {
    const metode = document.querySelector('input[name="metode_pengambilan"]:checked').value;
    const ekspedisiDiv = document.getElementById('ekspedisi_article');
    ekspedisiDiv.style.display = metode === 'kirim ke alamat' ? 'block' : 'none';
}


// delete
function confirmDelete(id_pengajuan) {
    if (confirm("Apakah Anda yakin ingin menghapus pengajuan ini?")) {
        window.location.href = '../proses/delete_pengajuan.php?id_pengajuan=' + id_pengajuan;
    }
}

// Script datatable

// Table pagination
new DataTable('#table-p', {
    layout: {
        stateSave: true,
        responsive: true,
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
        scrollY: '50vh',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });


    tabel.buttons().container()
        .appendTo('#table-s_wrapper .col-md-6:eq(0)');

});

$(document).ready(function () {

    var table = $('#table-s2').DataTable({

        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });


    tabel.buttons().container()
        .appendTo('#table-s23_wrapper .col-md-6:eq(0)');

});

$(document).ready(function () {

    var table = $('#table-s3').DataTable({

        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });


    tabel.buttons().container()
        .appendTo('#table-s3_wrapper .col-md-6:eq(0)');

});

$(document).ready(function () {

    var table = $('#table-s4').DataTable({

        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });


    tabel.buttons().container()
        .appendTo('#table-s4_wrapper .col-md-6:eq(0)');

});

$(document).ready(function () {

    var table = $('#table-s5').DataTable({

        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: false,
        scrollCollapse: true,
        scrollY: '50vh',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });


    tabel.buttons().container()
        .appendTo('#table-s_wrapper .col-md-6:eq(0)');

});

// Table scroll + pagination
$(document).ready(function () {

    var table = $('#table-s-p').DataTable({

        stateSave: true,
        responsive: true,
        colReorder: true,
        paging: true,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']

    });


    tabel.buttons().container()
        .appendTo('#table-s-p_wrapper .col-md-6:eq(0)');

});