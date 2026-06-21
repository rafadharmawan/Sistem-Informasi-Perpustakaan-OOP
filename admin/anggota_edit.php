<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/member.php';

    $member = new Member();

    $id = $_GET['id'];
    $row = $member->getBYid($id);

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $member->update($id, $nama, $email);
        header('location: anggota.php');
    }
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
         <header class="main-header">
            <div class="main-logo">Perpus <span>Digital</span></div>
        </header>

        <div class="admin-container">
            <h1 class="h1-tambah">Edit Anggota</h1>

            <div class="form-card">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">

                    <p>Nama Lengkap</p>
                    <input type="text" class="input" name="nama" value="<?= $row['nama']; ?>">
                    <br><br>

                    <p>Email</p>
                    <input type="email" class="input" name="email" value="<?= $row['email']; ?>">
                    <br><br>

                    <button type="submit" class="button" name="submit">Update</button>
                    <a href="anggota.php"><button type="button" class="button">Batal</button></a>

                </form>
            </div>
        </div>
    </body>
</html>