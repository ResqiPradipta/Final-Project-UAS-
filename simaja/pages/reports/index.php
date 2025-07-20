<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

// Ambil data aset
$aset = $conn->query("
    SELECT assets.*, categories.nama AS kategori, locations.nama AS lokasi 
    FROM assets 
    LEFT JOIN categories ON assets.kategori_id = categories.id
    LEFT JOIN locations ON assets.lokasi_id = locations.id
");


// Ambil data perawatan
$perawatan = $conn->query("
    SELECT maintenance.*, assets.nama AS aset 
    FROM maintenance 
    LEFT JOIN assets ON maintenance.aset_id = assets.id
");
?>

<div class="container mt-4">
    <h3>Laporan Data Aset</h3>
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $aset->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['kategori'] ?></td>
                <td><?= $row['lokasi'] ?></td>
                <td><?= $row['tanggal_beli'] ?></td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>

    <h3>Laporan Jadwal Perawatan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $perawatan->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['aset'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
