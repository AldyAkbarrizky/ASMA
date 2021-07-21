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
    
    $id_materi = $_GET['materi'];
    $deleteMateri = $table->updateOne(
        array('_id' => new MongoDB\BSON\ObjectID($_POST['id_matkul'])),
        array(
            '$pull' => array(
                'materi_kuliah' => array(
                    'id_materi' => new MongoDB\BSON\ObjectID($id_materi)
                )
            )
        )
    );

    if($deleteMateri) {
        header("Location: materi.php?matkul=".$_POST['id_matkul']);
    }

?>