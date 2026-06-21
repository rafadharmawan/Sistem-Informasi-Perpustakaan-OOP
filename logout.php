<?php
    session_start();

    if(isset($_SESSION['admin'])){
        session_destroy();
        header('location: /perpustakaan/admin/login.php');
    }else{
        session_destroy();
        header('location: /perpustakaan/user/login.php');
    }
?>