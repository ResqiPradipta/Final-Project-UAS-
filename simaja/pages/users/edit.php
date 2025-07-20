<?php
include '../../includes/auth_check.php';
include '../../config/db.php';
include '../../includes/header.php';
include '../../includes/navbar.php';

$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
$roles = $conn->query("SELECT * FROM roles");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role_id = $_POST['role_id'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET nama='$nama', username='$username', password='$password', role_id=$role_id WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET nama='$nama', username='$username', role_id=$role_id WHERE id=$id");
    }

    header("Location: list.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Edit User</h3>
    <form method="POST">
        <div class="mb-3"><input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required></div>
        <div class="mb-3"><input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required></div>
        <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah"></div>
        <div class="mb-3">
            <select name="role_id" class="form-control" required>
                <?php while ($r = $roles->fetch_assoc()) : ?>
                    <option value="<?= $r['id'] ?>" <?= $r['id'] == $user['role_id'] ? 'selected' : '' ?>><?= $r['nama'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
