<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->TugasKelas;
    $kelas = $table->findOne(['kelas' => $_SESSION["Kelas"]]);

    $dt = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));
    $ts = $dt->getTimestamp()*1000;
    $today = new MongoDB\BSON\UTCDateTime($ts);
    
    $addTugas = $table->updateOne(
        array('_id' => new MongoDB\BSON\ObjectID($kelas['id_kelas'])),
        array('$push' => array('tugas' => array(
            'id_tugas' => new MongoDB\BSON\ObjectID(),
            'id_matkul' => new MongoDB\BSON\ObjectID($_POST['id_matkul']),
            'nama_tugas' => $_POST['nama_tugas'],
            'waktu_penugasan' => new MongoDB\BSON\UTCDateTime($ts),
            'waktu_deadline' => 
                new MongoDB\BSON\UTCDateTime($_POST['waktu_deadline']->getTimestamp()*1000),
            'dosen_pengampu' => $_POST["dosen"],
            "metode_pengerjaan" => $_POST["metode"],
            "deskripsi_tugas" => $_POST["deskripsi"]
        )))
        );

    if($addTugas) {
        header("Location: tugas-kelas.php");
    }

?>