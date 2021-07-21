<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->TugasKelas;
    $kelas = $table->findOne(['kelas' => $_SESSION["Kelas"]]);

    $date = date_create_from_format('m/d/Y', $_POST['deadline']);
    $timestamp = $date->getTimestamp()*1000;
    
    $id_kelas = $_POST['id_kelas'];
    $id_tugas = $_POST['id_tugas'];
    $updateTugas = $table->updateOne(
        array(
            '_id' => new MongoDB\BSON\ObjectID($id_kelas),
            'tugas.id_tugas' => new MongoDB\BSON\ObjectID($id_tugas)
        ),
        array('$set' => array(
            'tugas.$.nama_tugas' => $_POST['judul'],
            'tugas.$.waktu_deadline' => 
                new MongoDB\BSON\UTCDateTime($timestamp),
            'tugas.$.dosen_pengampu' => $_POST["dosen"],
            "tugas.$.metode_pengerjaan" => $_POST["metode"],
            "tugas.$.deskripsi_tugas" => $_POST["deskripsi"]
        ))
    );

    if($updateTugas) {
        header("Location: tugas-kuliah.php");
    }

?>