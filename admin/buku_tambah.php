<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/buku.php';
    require_once '../classes/kategori.php';

    $buku = new Buku();
    $kategori = new Kategori();

    if(isset($_POST['submit'])){
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun = $_POST['tahun_terbit'];
        $stok = $_POST['stok'];
        $deskripsi = $_POST['deskripsi'];
        $idkategori = $_POST['id_kategori'];
        $buku->create($judul, $pengarang, $penerbit, $tahun, $stok, $deskripsi, $idkategori);
        header('location: buku.php');
    }

    $resultKategori = $kategori->getAll();
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
         <header class="main-header">
            <div class="main-logo">Perpus <span>Digital</span></div>
        </header>

        <div class="admin-container">
            <h1 class="h1-tambah">Tambah Buku</h1>

            <div class="form-card">
                <form method="POST">
                    <p>Judul</p>
                    <input type="text" class="input" name="judul" placeholder="Judul buku">
                    <br><br>
                    <p>Pengarang</p>
                    <input type="text" class="input" name="pengarang" placeholder="Nama pengarang">
                    <br><br>
                    <p>Penerbit</p>
                    <input type="text" class="input" name="penerbit" placeholder="Nama penerbit">
                    <br><br>
                    <p>Tahun Terbit</p>
                    <input type="number" class="input" name="tahun_terbit" placeholder="Contoh: 2023">
                    <br><br>
                    <p>Stok</p>
                    <input type="number" class="input" name="stok" placeholder="Jumlah stok">
                    <br><br>
                    <p>Deskripsi</p>
                    <textarea class="input" name="deskripsi" placeholder="Deskripsi buku"></textarea>
                    <br><br>
                    <p>Kategori</p>
                    <select class="input" name="id_kategori">
                        <option value="">-- Pilih Kategori --</option>
                        <?php while($kat = $resultKategori->fetch_assoc()){ ?>
                            <option value="<?= $kat['id']; ?>"><?= $kat['nama']; ?></option>
                        <?php } ?>
                    </select>
                    <br><br>
                    <button type="submit" class="button" name="submit">Tambah</button>
                    <a href="buku.php"><button type="button" class="button">Batal</button></a>
                </form>
            </div>
        </div>
    </body>
</html>