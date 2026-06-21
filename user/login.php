<?php
    session_start();
    require_once '../classes/member.php';


    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        $member = new Member();
        $row = $member->login($email, $password);

        if($row){
            $_SESSION['member'] = $row['nama'];
            $_SESSION['member_id'] = $row['id'];
            header('location: index.php');
        }else{
            $error = "Email atau password salah!";
        }
    }
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <div class="login-container">
            <div class="card">
                <h1>Login Member</h1>

                <?php if(isset($_GET['register'])){ ?>
                    <p class="reg-berhasil">Registrasi berhasil! Silakan login.</p>
                <?php } ?>

                <?php if(isset($error)){ ?>
                    <p><?php echo $error;?></p>
                <?php }?>
                <br>

                <form method="POST">
                    <p>Email</p>
                    <input type="email" class="input" name="email" placeholder="Masukan email">
                    <br><br>
                    <p>Password</p>
                    <input type="password" class="input" name="password" placeholder="Masukan password">
                    <br><br>
                    <button type="submit" class="button" name="submit">Login</button>
                </form>

                <br>
                <p>Belum punya akun? <a href="/perpustakaan/register.php">Daftar disini</a></p>
            </div>
        </div>
    </body>
</html>