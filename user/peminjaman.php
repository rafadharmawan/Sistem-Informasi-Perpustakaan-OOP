<?php
    session_start();
    if(!isset($_SESSION['member'])){
        header('location: ../login.php');
    }

    require_once '../classes/peminjaman.php';

    $peminjaman = new Peminjaman();
    $idmember = $_SESSION['member_id'];
    $data = $peminjaman->getBYmember($idmember);
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <header class="main-header">
            <div class="main-logo">Perpus <span>Digital</span></div>
                <div>
                    <a href="/perpustakaan/user/index.php">Home</a>
                    <a href="/perpustakaan/user/peminjaman.php">Peminjaman Saya</a>
                    <a href="/perpustakaan/logout.php">Logout</a>
                </div>
        </header>  

        <div class="admin-container">
            <h1>Peminjaman Saya</h1>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while($row = $data->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['judul_buku']; ?></td>
                            <td><?= $row['tanggal_pinjam']; ?></td>
                            <td><?= $row['status']; ?></td>
                        </tr>
                    <?php
                            $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>