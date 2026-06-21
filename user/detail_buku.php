<?php
    session_start();
    if(!isset($_SESSION['member'])){
        header('location: ../login.php');
    }

    require_once '../classes/buku.php';
    require_once '../classes/peminjaman.php';

    $buku = new Buku();
    $peminjaman = new Peminjaman();
    $id = $_GET['id'];
    $row = $buku->getBYid($id);

    if(isset($_POST['pinjam'])){
        $idmember = $_SESSION['member_id'];
        $idbuku = $_POST['id_buku'];
        $tanggal = date('Y-m-d');
        $peminjaman->create($idmember, $idbuku, $tanggal);
        $buku->kurangiStok($idbuku);
        header('location: peminjaman.php');
    }
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <?php include '../library/navbar_user.php'; ?>
        <div class="admin-container">
            <div class="detail-card">
                <h1><?= $row['judul']; ?></h1>
                <hr>
                <p>Pengarang:</p>
                <h3><?= $row['pengarang']; ?></h3>
                <hr>
                <p>Penerbit:</p>
                <h3><?= $row['penerbit']; ?></h3>
                <hr>
                <p>Tahun Terbit:</p>
                <h3><?= $row['tahun_terbit']; ?></h3>
                <hr>
                <p>Kategori:</p>
                <h3><?= $row['nama_kategori']; ?></h3>
                <hr>
                <p>Stok:</p>
                <h3><?= $row['stok']; ?> buku</h3>
                <hr>
                <p>Deskripsi:</p>
                <h3><?= $row['deskripsi']; ?></h3>
                <br>
                <?php if($row['stok'] > 0){ ?>
                    <form method="POST">
                        <input type="hidden" name="id_buku" value="<?= $row['id']; ?>">
                        <button type="submit" class="button" name="pinjam" onclick="return confirm('Yakin ingin meminjam buku ini?')">Pinjam Buku</button>
                    </form>
                <?php }else{ ?>
                    <p style="color: red">Stok habis, buku tidak tersedia</p>
                <?php } ?>

            </div>
        </div>
    </body>
</html>