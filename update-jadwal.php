<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->JadwalMataKuliah;
    $table2 = $database->TugasKelas;
    $kelas = $table2->findOne(['kelas' => $_SESSION["Kelas"]]);

    $dt = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));
    $ts = $dt->getTimestamp()*1000;
    $today = new MongoDB\BSON\UTCDateTime($ts);
    
    $id_jadwal = $_GET['jadwal'];
    $updateJadwalSenin = $table->updateOne(
        array(
            '_id' => $id_jadwal,
            'jadwal_senin' => array(
                '$elemMatch' => array(
                    'id_matkul' => new MongoDB\BSON\ObjectId($_POST['id_matkul'])
                )
            )
        ),
        array(
            '$set' => array(
                'jam_awal' => $_POST['jam_awal'],
                'jam_akhir' => $_POST['jam_akhir'],
                'jenis_matkul' => $_POST['jenis']
            )
        )
    );

    if($updateJadwalSenin) {
        header("Location: jadwal-kelas.php");
    }

?>