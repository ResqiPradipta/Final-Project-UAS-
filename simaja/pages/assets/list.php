<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

// Query dengan JOIN ke categories dan locations
$query = "
    SELECT 
        assets.*, 
        categories.nama AS kategori, 
        locations.nama AS lokasi 
    FROM assets
    LEFT JOIN categories ON assets.kategori_id = categories.id
    LEFT JOIN locations ON assets.lokasi_id = locations.id
";
$result = $conn->query($query);
?>

<div class="container mt-4">
    <h3>Manajemen Aset</h3>
    <a href="create.php" class="btn btn-primary mb-3">+ Tambah Aset</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Tanggal Beli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['kategori'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['lokasi'] ?? '-') ?></td>
                <td><?= $row['tanggal_beli'] ? date('d-m-Y', strtotime($row['tanggal_beli'])) : '-' ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus aset ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
