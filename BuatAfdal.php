<?php

    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->MateriKuliah;
    $materi = $table->aggregate(
        [
            ['$match' => ['_id' => new MongoDB\BSON\ObjectID("60f73fdd3e2e00008d004bf6")]],
        ]
    );
    var_dump($materi)
?>