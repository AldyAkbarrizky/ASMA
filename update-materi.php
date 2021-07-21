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
    
    $id_matkul = $_POST['id_matkul'];
    $id_materi = $_POST['id_materi'];
    $updateMateri = $table->updateOne(
        array(
            '_id' => new MongoDB\BSON\ObjectID($id_matkul),
            'materi_kuliah.id_materi' => new MongoDB\BSON\ObjectID($id_materi)
        ),
        array('$set' => array(
            'materi_kuliah.$.judul_materi' => $_POST['judul_materi'],
            'materi_kuliah.$.deskripsi' => $_POST['deskripsi_materi']
        ))
    );

    if($updateMateri) {
        header("Location: materi.php?matkul=".$id_matkul);
    }

?>