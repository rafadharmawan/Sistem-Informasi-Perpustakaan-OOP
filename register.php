<?php
    require_once 'classes/member.php';

     if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        $member = new Member();

        if($member->cekEmail($email) > 0){
            $error = "Email sudah terdaftar!";
        }else{
            $member->create($nama, $email, $password);
            header('location: /perpustakaan/user/login.php?register=success');
        }
    }
?>

    <html>
    <?php include 'library/header.php'; ?>
    <body>
        <div class="login-container">
            <div class="card">
                <h1>Register</h1>

                <?php if(isset($_GET['register'])){ ?>
                    <p class="reg-berhasil">Registrasi berhasil! Silakan login.</p>
                <?php } ?>

                <?php if(isset($error)){?>
                    <p><?php echo $error;?></p>
                <?php }?>
                <br>

                <form method="POST">
                    <p>Nama Lengkap</p>
                    <input type="text" class="input" name="nama" placeholder="Masukan Nama Lengkap">
                    <p>Email</p>
                    <input type="email" class="input" name="email" placeholder="Masukan Email">
                    <br>
                    <p>Password</p>
                    <input type="password" class="input" name="password" placeholder="Masukan Password">
                    <br><br>
                    <button type="submit" class="button" name="submit">Register</button>
                </form>

                <br>
                <p>sudah punya akun? <a href="/perpustakaan/user/login.php">Login disini</a></p>
            </div>
        </div>
    </body>
</html>
