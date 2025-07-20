<?php
session_start();
require_once 'config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role_id = intval($_POST['role_id']);

    // Cek apakah username sudah digunakan
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $error = "Username sudah terdaftar.";
    } else {
        // Simpan user baru
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO users (nama, username, password, role_id) VALUES (?, ?, ?, ?)");
        $insert->bind_param("sssi", $nama, $username, $hash, $role_id);
        if ($insert->execute()) {
            $success = "Registrasi berhasil. Silakan login.";
        } else {
            $error = "Gagal mendaftar user.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Registrasi Pengguna Baru</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="1">Admin</option>
                <option value="2">Teknisi</option>
                <option value="3">Viewer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Daftar</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
