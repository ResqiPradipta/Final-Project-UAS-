<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$aset = $conn->query("SELECT * FROM assets");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aset_id = $_POST['aset_id'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("INSERT INTO maintenance (aset_id, deskripsi, tanggal, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $aset_id, $deskripsi, $tanggal, $status);
    $stmt->execute();
    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Tambah Perawatan Aset</h3>
    <form method="POST">
        <div class="mb-3">
            <select name="aset_id" class="form-control" required>
                <option value="">-- Pilih Aset --</option>
                <?php while ($a = $aset->fetch_assoc()) : ?>
                    <option value="<?= $a['id'] ?>"><?= $a['nama'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3"><input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required></div>
        <div class="mb-3"><input type="date" name="tanggal" class="form-control" required></div>
        <div class="mb-3">
            <select name="status" class="form-control" required>
                <option value="Terjadwal">Terjadwal</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
