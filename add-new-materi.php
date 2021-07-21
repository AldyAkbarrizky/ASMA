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

    $dt = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));
    $ts = $dt->getTimestamp()*1000;
    $today = new MongoDB\BSON\UTCDateTime($ts);
    
    $addMateri = $table->updateOne(
        array('_id' => new MongoDB\BSON\ObjectID($_POST['id_matkul'])),
        array('$push' => array('materi_kuliah' => array(
            'id_materi' => new MongoDB\BSON\ObjectID(),
            'judul_materi' => $_POST['judul_materi'],
            'tanggal_materi' => new MongoDB\BSON\UTCDateTime($ts),
            'deskripsi' => $_POST['deskripsi_materi']
        )))
        );

    if($addMateri) {
        header("Location: materi.php?matkul=".$_POST['id_matkul']);
    }

?>