<?php
// Aktifkan debug (sementara)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mulai session
session_start();

// Koneksi ke database
require_once 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil user berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika user ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Periksa kecocokan password
        if (password_verify($password, $user['password'])) {
            // Simpan data user ke session
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit;
        } else {
            $error = 'Password salah.';
        }
    } else {
        $error = 'Username tidak ditemukan.';
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-4">Login SIMAJA</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <div class="text-center mt-3">
    <a href="register.php">Belum punya akun? Daftar di sini</a>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
