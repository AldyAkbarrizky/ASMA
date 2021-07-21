<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->AnnouncementKomentar;
    $table2 = $database->TugasKelas;
    $kelas = $table2->findOne(['kelas' => $_SESSION["Kelas"]]);
    
    $id_announcement = $_GET['announcement'];
    $deleteAnnouncement = $table->deleteOne(
        array('_id' => $id_announcement)
    );

    if($deleteAnnouncement) {
        header("Location: announcement-kelas.php");
    }

?>