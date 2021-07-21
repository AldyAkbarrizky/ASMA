<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->AnnouncementKomentar;
    $table2 = $database->TugasKelas;
    $table3 = $database->Mahasiswa;
    $kelas = $table2->findOne(['kelas' => $_SESSION["Kelas"]]);
    $mhs = $table3->findOne(['NIM' => $_SESSION["NIM"]]);

    $dt = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));
    $ts = $dt->getTimestamp()*1000;
    $today = new MongoDB\BSON\UTCDateTime($ts);
    
    $addAnnouncement = $table->insertOne([
        'id_mahasiswa' => $mhs['_id'],
        'id_kelas' => $kelas["id_kelas"],
        'judul' => $_POST["judul"],
        'deskripsi' => $_POST["deskripsi"],
        'waktu_posting' => new MongoDB\BSON\UTCDateTime($ts)
    ]);

    if($addAnnouncement) {
        header("Location: announcement-kelas.php");
    }

?>