<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/peminjaman.php';

    $peminjaman = new Peminjaman();
    $status = '';
    if(isset($_GET['filter'])){
        $status = $_GET['status'];
    }

    if($status != ''){
        $result = $peminjaman->getBystatus($status);
    }else{
        $result = $peminjaman->getAll();
    }

    $totalSemua = $peminjaman->getAll()->num_rows;
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
            <h1>Laporan Peminjaman</h1>
            <div class="stat-card">
                <h2><?= $totalSemua; ?></h2>
                <p>Total Peminjaman</p>
            </div>
            <br><br>
            <form method="GET">
                <select class="input" name="status">
                    <option value="">Semua Status</option>
                    <option value="dipinjam" <?php echo ($status == 'dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                    <option value="dikembalikan" <?php echo ($status == 'dikembalikan') ? 'selected' : ''; ?>>Dikembalikan</option>
                </select>
                <br><br>
                <button type="submit" class="button" name="filter">Confirm</button>
                <a href="laporan.php"><button type="button" class="button">Reset</button></a>
            </form>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Member</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($result->num_rows > 0){
                            $no = 1;
                            while($row = $result->fetch_assoc()){
                                echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.$row['nama_member'].'</td>
                                    <td>'.$row['judul_buku'].'</td>
                                    <td>'.$row['tanggal_pinjam'].'</td>
                                    <td>'.$row['status'].'</td>
                                </tr>';
                                $no++;
                            }
                        }else{
                            echo '<tr><td colspan="5">Tidak ada data.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>