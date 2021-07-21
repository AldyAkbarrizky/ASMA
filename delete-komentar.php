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
    
    $id_announcement = $_POST['announcement'];
    $id_komentar = $_POST['komentar'];
    $deleteMateri = $table->updateOne(
        array(
            '_id' => $id_announcement
        ),
        array('$pull' => array(
            'komentar' => array(
                'id_komentar' => $id_komentar
            )
        ))
    );

    if($deleteKomentar) {
        header("Location: announcement-kuliah.php");
    }

?>