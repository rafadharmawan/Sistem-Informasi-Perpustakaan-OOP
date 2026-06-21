<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/kategori.php';

    $kategori = new Kategori();

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $kategori->create($nama);
        header('location: kategori.php');
    }
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <header class="main-header">
            <div class="main-logo">Perpus <span>Digital</span></div>
        </header>

        <div class="admin-container">
            <h1 class="h1-tambah">Tambah Kategori</h1>

            <div class="form-card">
                <form method="POST">

                    <p>Nama Kategori</p>
                    <input type="text" class="input" name="nama" placeholder="Contoh: Fiksi, Sains">
                    <br><br>

                    <button type="submit" class="button" name="submit">Tambah</button>
                    <a href="kategori.php"><button type="button" class="button">Batal</button></a>

                </form>
            </div>
        </div>
    </body>
</html>