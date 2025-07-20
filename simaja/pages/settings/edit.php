<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM categories WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $stmt = $conn->prepare("UPDATE categories SET nama=? WHERE id=?");
    $stmt->bind_param("si", $nama, $id);
    $stmt->execute();
    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Edit Kategori</h3>
    <form method="POST">
        <div class="mb-3"><input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
