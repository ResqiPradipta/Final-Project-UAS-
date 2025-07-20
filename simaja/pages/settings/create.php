<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $stmt = $conn->prepare("INSERT INTO categories (nama) VALUES (?)");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Tambah Kategori</h3>
    <form method="POST">
        <div class="mb-3"><input type="text" name="nama" class="form-control" placeholder="Nama Kategori" required></div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
