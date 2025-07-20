<?php
include 'includes/auth_check.php';
include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Statistik ringkas
$jumlah_aset = $conn->query("SELECT COUNT(*) AS total FROM assets")->fetch_assoc()['total'];
$jumlah_user = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$jumlah_maintenance = $conn->query("SELECT COUNT(*) AS total FROM maintenance")->fetch_assoc()['total'];
?>

<div class="container mt-5">
    <h1 class="mb-4">Dashboard SIMAJA</h1>
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h4>Total Aset</h4>
                    <p class="display-6"><?= $jumlah_aset ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h4>Total User</h4>
                    <p class="display-6"><?= $jumlah_user ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h4>Total Perawatan</h4>
                    <p class="display-6"><?= $jumlah_maintenance ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
