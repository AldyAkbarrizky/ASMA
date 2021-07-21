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
    
    $id_matkul = $_GET['matkul'];
    $updateMatkul = $table->insertOne(
        array('_id' => $id_matkul),
        array('$set' => array(
            'nama_matkul' => $_POST["Matkul"]
        ))
    );

    if($updateMatkul) {
        header("Location: materi-kuliah.php");
    }

?>