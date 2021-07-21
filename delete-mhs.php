<?php

    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->Mahasiswa;
    $table2 = $database->TugasKelas;
    $kelas = $table2->findOne(['kelas' => $_SESSION["Kelas"]]);
    
    $id_mhs = $_GET['id'];
    $deleteMHS = $table->deleteOne(array('_id' => $id_mhs));

    if($deleteMHS) {
        header("Location: anggota-kelas.php");
    }

?>