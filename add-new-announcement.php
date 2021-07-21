<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->AnnouncementKomentar;

    $id_mhs = $_POST['id_mahasiswa'];
    $id_kelas = $_POST['id_kelas'];
    $dt = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));
    $ts = $dt->getTimestamp()*1000;
    $today = new MongoDB\BSON\UTCDateTime($ts);
    
    $addAnnouncement = $table->insertOne([
        'id_mahasiswa' => new MongoDB\BSON\ObjectID($id_mhs),
        'id_kelas' => $id_kelas,
        'judul' => $_POST["judul"],
        'deskripsi' => $_POST["deskripsi"],
        'waktu_posting' => new MongoDB\BSON\UTCDateTime($ts)
    ]);

    if($addAnnouncement) {
        header("Location: announcement.php");
    }

?>