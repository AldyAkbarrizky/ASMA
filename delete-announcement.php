<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->AnnouncementKomentar;
    
    $id_announcement = $_GET['id_announce'];
    $deleteAnnouncement = $table->deleteOne(
        array('_id' => new MongoDB\BSON\ObjectID($id_announcement))
    );

    if($deleteAnnouncement) {
        header("Location: announcement.php");
    }

?>