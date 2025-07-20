<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$result = $conn->query("
    SELECT maintenance.*, assets.nama AS aset 
    FROM maintenance 
    LEFT JOIN assets ON maintenance.aset_id = assets.id
");
?>

<div class="container mt-4">
    <h3>Jadwal Perawatan Aset</h3>
    <a href="create.php" class="btn btn-primary mb-3">+ Tambah Perawatan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aset</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['aset'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
