<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/peminjaman.php';
    require_once '../classes/buku.php';

    $peminjaman = new Peminjaman();
    $buku = new Buku();

    if(isset($_GET['kembalikan'])){
        $idPeminjaman = $_GET['kembalikan'];
        $idbuku = $_GET['id_buku'];
        $peminjaman->kembalikan($idPeminjaman);
        $buku->tambahStok($idbuku);

        header('location: peminjaman.php');
    }

    $result = $peminjaman->getAll();
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
            <h1>Data Peminjaman</h1>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Member</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while($row = $result->fetch_assoc()){
                            echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$row['nama_member'].'</td>
                                <td>'.$row['judul_buku'].'</td>
                                <td>'.$row['tanggal_pinjam'].'</td>
                                <td>'.$row['status'].'</td>
                                <td>';
                            if($row['status'] == 'dipinjam'){
                                echo '<a href="peminjaman.php?kembalikan='.$row['id'].'&id_buku='.$row['id_buku'].'" onclick="return confirm(\'Konfirmasi pengembalian buku ini?\')"><button class="button">Konfirmasi Kembali</button></a>';
                            }else{
                                echo 'Sudah dikembalikan';
                            }
                            echo '</td>
                            </tr>';
                            $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>