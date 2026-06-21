<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/kategori.php';

    $kategori = new Kategori();
    $id = $_GET['id'];
    $row = $kategori->getBYid($id);

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $kategori->update($id, $nama);
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
            <h1 class="h1-tambah">Edit Kategori</h1>

            <div class="form-card">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">

                    <p>Nama Kategori</p>
                    <input type="text" class="input" name="nama" value="<?= $row['nama']; ?>">
                    <br><br>

                    <button type="submit" class="button" name="submit">Update</button>
                    <a href="kategori.php"><button type="button" class="button">Batal</button></a>

                </form>
            </div>
        </div>
    </body>
</html>