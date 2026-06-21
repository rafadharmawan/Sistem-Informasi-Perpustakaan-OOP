<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/buku.php';
    require_once '../classes/kategori.php';
    require_once '../classes/member.php';

    $buku = new Buku();
    $kategori = new Kategori();
    $member = new Member();

    $totalBuku = $buku->getAll()->num_rows;
    $totalKategori = $kategori->getAll()->num_rows;
    $totalMember = $member->getAll()->num_rows;
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <header class="main-header">
            <div class="main-logo">Perpus <span>Digital</span></div>
            <div>
                <a href="/perpustakaan/admin/dashboard.php">Dashboard</a>
                <a href="/perpustakaan/admin/buku.php">Buku</a>
                <a href="/perpustakaan/admin/kategori.php">Kategori</a>
                <a href="/perpustakaan/admin/anggota.php">Anggota</a>
                <a href="/perpustakaan/admin/laporan.php">Laporan</a>
                <a href="/perpustakaan/admin/peminjaman.php">Peminjaman</a>
                <a href="/perpustakaan/logout.php">Logout</a>
            </div>
        </header>

        <div class="admin-container">
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, <?= $_SESSION['admin']; ?></p>
            <br>

            <div class="stat-card">
                <h2><?= $totalBuku; ?></h2>
                <p>Total Buku</p>
            </div>

            <div class="stat-card">
                <h2><?= $totalKategori; ?></h2>
                <p>Total Kategori</p>
            </div>

            <div class="stat-card">
                <h2><?= $totalMember; ?></h2>
                <p>Total Member</p>
            </div>
        </div>
    </body>
</html>