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
    
    $id_materi = $_GET['materi'];
    $updateMateri = $table->insertOne(
        array('materi_kuliah._id' => $id_materi),
        array('$set' => array(
            'judul_materi' => $_POST['judul_materi'],
            'deskripsi' => $_POST['deskripsi_materi']
        ))
    );

    if($updateMateri) {
        header("Location: materi-kuliah.php");
    }

?>