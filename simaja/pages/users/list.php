<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$result = $conn->query("SELECT users.*, roles.nama AS role FROM users LEFT JOIN roles ON users.role_id = roles.id");
?>

<div class="container mt-4">
    <h3>Manajemen Pengguna</h3>
    <a href="create.php" class="btn btn-primary mb-3">+ Tambah User</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['role'] ?></td>
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
