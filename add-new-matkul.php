<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->MateriKuliah;
    $table2 = $database->TugasKelas;
    $kelas = $table2->findOne(['kelas' => $_SESSION["Kelas"]]);
    
    $addMHS = $table->insertOne([
        'nama_matkul' => $_POST["Matkul"],
        'id_kelas' => $kelas["id_kelas"],
    ]);

    if($addMHS) {
        header("Location: materi-kuliah.php");
    }

?>