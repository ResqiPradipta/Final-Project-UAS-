<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$id = $_GET['id'];
$aset = $conn->query("SELECT * FROM assets WHERE id = $id")->fetch_assoc();
$kategori = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $kategori_id = $_POST['kategori_id'];
    $lokasi = $_POST['lokasi'];
    $tanggal_beli = $_POST['tanggal_beli'];

    $stmt = $conn->prepare("UPDATE assets SET nama=?, kategori_id=?, lokasi=?, tanggal_beli=? WHERE id=?");
    $stmt->bind_param("sissi", $nama, $kategori_id, $lokasi, $tanggal_beli, $id);
    $stmt->execute();

    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Edit Aset</h3>
    <form method="POST">
        <div class="mb-3"><input type="text" name="nama" class="form-control" value="<?= $aset['nama'] ?>" required></div>
        <div class="mb-3">
            <select name="kategori_id" class="form-control" required>
                <?php while ($row = $kategori->fetch_assoc()) : ?>
                    <option value="<?= $row['id'] ?>" <?= $aset['kategori_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['nama'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3"><input type="text" name="lokasi" class="form-control" value="<?= $aset['lokasi'] ?>" required></div>
        <div class="mb-3"><input type="date" name="tanggal_beli" class="form-control" value="<?= $aset['tanggal_beli'] ?>" required></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
