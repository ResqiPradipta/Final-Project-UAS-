<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$roles = $conn->query("SELECT * FROM roles");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = $_POST['role_id'];
    $stmt = $conn->prepare("INSERT INTO users (nama, username, password, role_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama, $username, $password, $role_id);
    $stmt->execute();
    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Tambah User</h3>
    <form method="POST">
        <div class="mb-3"><input type="text" name="nama" class="form-control" placeholder="Nama" required></div>
        <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
        <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
        <div class="mb-3">
            <select name="role_id" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <?php while ($r = $roles->fetch_assoc()) : ?>
                    <option value="<?= $r['id'] ?>"><?= $r['nama'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
