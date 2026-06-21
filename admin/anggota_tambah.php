<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    require_once '../classes/member.php';

    $member = new Member();

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        $member->create($nama, $email, $password);
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
            <h1 class="h1-tambah">Tambah Anggota</h1>

            <div class="form-card">
                <form method="POST">

                    <p>Nama Lengkap</p>
                    <input type="text" class="input" name="nama" placeholder="Nama lengkap">
                    <br><br>

                    <p>Email</p>
                    <input type="email" class="input" name="email" placeholder="Email">
                    <br><br>

                    <p>Password</p>
                    <input type="password" class="input" name="password" placeholder="Password">
                    <br><br>

                    <button type="submit" class="button" name="submit">Tambah</button>
                    <a href="anggota.php"><button type="button" class="button">Batal</button></a>

                </form>
            </div>
        </div>
    </body>
</html>