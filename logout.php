<?php

    session_start();
    $_SESSION["Nama"] = '';
    $_SESSION["NIM"] = '';
    $_SESSION["Role"] = '';
    $_SESSION["Kelas"] = '';
    unset($_SESSION['Nama']);
    unset($_SESSION['NIM']);
    unset($_SESSION['Role']);
    unset($_SESSION['Kelas']);
    session_unset();
    session_destroy();
    header("Location: authentication-login.php");
    
?>