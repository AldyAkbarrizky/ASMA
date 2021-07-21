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
    
    $id_kelas = $_GET['id_kelas'];
    $id_tugas = $_GET['id_tugas'];
    $deleteTugas = $table->updateOne(
        array('_id' => new MongoDB\BSON\ObjectID($id_kelas)),
        array(
            '$pull' => array(
                'tugas' => array(
                    'id_tugas' => new MongoDB\BSON\ObjectID($id_tugas)
                )
            )
        )
    );

    if($deleteTugas) {
        header("Location: tugas-kuliah.php");
    }

?>