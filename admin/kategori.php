<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/kategori.php';

    $kategori = new Kategori();

    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];
        $kategori->delete($id);
        header('location: kategori.php');
    }

    $result = $kategori->getAll();
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
        </header>

        <div class="admin-container">
            <h1>Kelola Kategori</h1>
            <a href="kategori_tambah.php"><button class="button">Tambah Kategori</button></a>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while($row = $result->fetch_assoc()){
                            echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$row['nama'].'</td>
                                <td>
                                    <a href="kategori_edit.php?id='.$row['id'].'"><button class="button">Edit</button></a>
                                    <a href="kategori.php?hapus='.$row['id'].'" onclick="return confirm(\'Yakin hapus?\')"><button class="button">Hapus</button></a>
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