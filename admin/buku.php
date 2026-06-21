<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/buku.php';

    $buku = new Buku();

    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $buku->delete($id);
        header('location: buku.php');
    }

    $result = $buku->getAll();
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
            <h1>Kelola Buku</h1>
            <a href="buku_tambah.php"><button class="button">+ Tambah Buku</button></a>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while($row = $result->fetch_assoc()){
                            echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$row['judul'].'</td>
                                <td>'.$row['pengarang'].'</td>
                                <td>'.$row['penerbit'].'</td>
                                <td>'.$row['tahun_terbit'].'</td>
                                <td>'.$row['stok'].'</td>
                                <td>'.$row['nama_kategori'].'</td>
                                <td>
                                    <a href="buku_edit.php?id='.$row['id'].'"><button class="button">Edit</button></a>
                                    <a href="buku.php?hapus='.$row['id'].'" onclick="return confirm(\'Yakin untuk menghapus?\')"><button class="button">Hapus</button></a>
                                </td>
                            </tr>';
                            $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>