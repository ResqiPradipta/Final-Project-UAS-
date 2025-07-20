<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$kategori = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $kategori_id = $_POST['kategori_id'];
    $lokasi = $_POST['lokasi'];
    $tanggal_beli = $_POST['tanggal_beli'];
    $stmt = $conn->prepare("INSERT INTO assets (nama, kategori_id, lokasi, tanggal_beli) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nama, $kategori_id, $lokasi, $tanggal_beli);
    $stmt->execute();
    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Tambah Aset</h3>
    <form method="POST">
        <div class="mb-3"><input type="text" name="nama" class="form-control" placeholder="Nama Aset" required></div>
        <div class="mb-3">
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($row = $kategori->fetch_assoc()) : ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3"><input type="text" name="lokasi" class="form-control" placeholder="Lokasi" required></div>
        <div class="mb-3"><input type="date" name="tanggal_beli" class="form-control" required></div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
