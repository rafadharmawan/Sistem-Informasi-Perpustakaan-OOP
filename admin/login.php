<?php
    session_start();
    require_once "../library/database.php";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = hash('sha256', $_POST['password']);
        $db = new Database();
        $query = "SELECT * FROM admin WHERE username='".$username."' AND password='".$password."'";
        $result = $db->getConnection()->query($query);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['admin'] = $row['username'];
            header('location: dashboard.php');
        }else{
            echo "Username atau password salah!";
        }
    }
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <div class="login-container">
            <div class="card">
                <h1>Login Admin</h1>
                <form method="POST">
                    <p>Username</p>
                    <input type="text" class="input" name="username" placeholder="Masukan username">
                    <br><br>
                    <p>Password</p>
                    <input type="password" class="input" name="password" placeholder="Masukan password">
                    <br><br>
                    <button type="submit" class="button" name="submit">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>