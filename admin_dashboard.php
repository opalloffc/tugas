<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$profile_name = $_SESSION['username'];
$profile_photo = isset($_SESSION['photo']) ? $_SESSION['photo'] : 'default.png';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <img src="uploads/<?php echo $profile_photo; ?>" alt="Foto Profil" class="profile-pic">
        <p><?php echo $profile_name; ?></p>
        <a href="dashboard.php">Beranda</a>
        <a href="tambah_produk.php">Tambah Produk</a>
        <a href="edit_profile.php">Edit Profil</a>
        <a href="logout.php">Logout</a>
    </div>


    <div class="content">
        <h1>Selamat Datang, <?php echo $profile_name; ?>!</h1>
        <h2>Produk Toko</h2>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "produk"); 
        if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
        }
        $query = mysqli_query($conn, "SELECT * FROM produk");
        ?>

        <div class="products">
            <?php while($row = mysqli_fetch_assoc($query)): ?>
                <div class="product-card">
                    <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama']; ?>">
                    <h3><?php echo $row['nama']; ?></h3>
                    <p>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>
