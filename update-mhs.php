<?php
    require_once __DIR__ . "./driver.php";

    session_start();
    if(!isset($_SESSION["Nama"])){ //if login in session is not set
        header("Location: authentication-login.php");
    }

    $database = $client->ASMA;
    $table = $database->Mahasiswa;
    $table2 = $database->TugasKelas;
    $kelas = $table2->findOne(['kelas' => $_SESSION["Kelas"]]);
    
    $id_mhs = $_POST['id-mhs'];
    $addMHS = $table->updateOne(
        array('_id' => new MongoDB\BSON\ObjectID($id_mhs)),
        array('$set' => array(
            'NIM' => $_POST["NIM"],
            'nama_mahasiswa' => $_POST["nama"],
            'alamat_surel' => $_POST["email"]
        ))
    );

    if($addMHS) {
        header("Location: anggota-kelas.php");
    }

?>