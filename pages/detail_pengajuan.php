<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan' && $_SESSION['role'] != 'alumni')) {
    header("Location: login_admin.php");
    exit;
}

$id_pengajuan = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Pengajuan WHERE id_pengajuan = ?");
$stmt->bind_param("i", $id_pengajuan);
$stmt->execute();
$result = $stmt->get_result();
$pengajuan = $result->fetch_assoc();

if ($_SESSION['role'] == 'staf' || $_SESSION['role'] == 'dekan') {
    $is_staf_or_dekan = true;
} else {
    $is_staf_or_dekan = false;
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/buttons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Status Pengajuan</title>
</head>

<body class="mt-2 bg-transparent">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <article class="bg-transparent py-1 px-md-5">
        <header class="form-outline mb-2">
            <label class="form-label form-label-white d-flex" class="form-label form-label-white d-flex">
                <span style="font-size: 1.5rem;">Detail Pengajuan</span></label>
        </header>
        <div class="table-responsive">
            <table class="mt-4 table table-bordered">
                <tr>
                    <th>NPM</th>
                    <td><?php echo htmlspecialchars($pengajuan['npm']); ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo htmlspecialchars($pengajuan['nama']); ?></td>
                </tr>
                <tr>
                    <th>Tahun Lulus</th>
                    <td><?php echo htmlspecialchars($pengajuan['tahun_lulus']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($pengajuan['email']); ?></td>
                </tr>
                <tr>
                    <th>Metode Pengambilan</th>
                    <td><?php echo htmlspecialchars($pengajuan['metode_pengambilan']); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Legalisir Ijazah</th>
                    <td><?php echo htmlspecialchars($pengajuan['jumlah_legalisir_ijazah']); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Legalisir Transkrip</th>
                    <td><?php echo htmlspecialchars($pengajuan['jumlah_legalisir_transkrip']); ?></td>
                </tr>
                <tr>
                    <th>Pengiriman</th>
                    <td><?php echo htmlspecialchars($pengajuan['ekspedisi_pengiriman']); ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td><?php echo htmlspecialchars($pengajuan['total_harga']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo htmlspecialchars($pengajuan['id_status']); ?></td>
                </tr>
            </table>

            <?php if ($is_staf_or_dekan): ?>
                <?php if ($_SESSION['role'] == 'staf' && $pengajuan['id_status'] == '1'): ?>
                    <a href="../proses/validasi_pengajuan.php?id=<?php echo $id_pengajuan; ?>"
                        class="btn btn-success">Validasi</a>
                <?php elseif ($_SESSION['role'] == 'dekan' && $pengajuan['id_status'] == '2'): ?>
                    <a href="../proses/pengesahan.php?id=<?php echo $id_pengajuan; ?>" class="btn btn-success">Sahkan</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
</body>

</html>