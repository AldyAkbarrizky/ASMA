<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->AnnouncementKomentar;
    
    $id_announcement = $_POST['id_announcement'];
    $updateAnnouncement = $table->updateOne(
        array('_id' => new MongoDB\BSON\ObjectID($id_announcement)),
        array(
            '$set' => array(
                'judul' => $_POST["judul"],
                'deskripsi' => $_POST["deskripsi"],
            )
        )
    );

    if($updateAnnouncement) {
        header("Location: announcement.php");
    }

?>