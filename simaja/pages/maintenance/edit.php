<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM maintenance WHERE id = $id")->fetch_assoc();
$aset = $conn->query("SELECT * FROM assets");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aset_id = $_POST['aset_id'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE maintenance SET aset_id=?, deskripsi=?, tanggal=?, status=? WHERE id=?");
    $stmt->bind_param("isssi", $aset_id, $deskripsi, $tanggal, $status, $id);
    $stmt->execute();

    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Edit Perawatan Aset</h3>
    <form method="POST">
        <div class="mb-3">
            <select name="aset_id" class="form-control" required>
                <?php while ($a = $aset->fetch_assoc()) : ?>
                    <option value="<?= $a['id'] ?>" <?= $a['id'] == $data['aset_id'] ? 'selected' : '' ?>><?= $a['nama'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3"><input type="text" name="deskripsi" class="form-control" value="<?= $data['deskripsi'] ?>" required></div>
        <div class="mb-3"><input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required></div>
        <div class="mb-3">
            <select name="status" class="form-control">
                <option value="Terjadwal" <?= $data['status'] == 'Terjadwal' ? 'selected' : '' ?>>Terjadwal</option>
                <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
