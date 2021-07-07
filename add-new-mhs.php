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
    
    $addMHS = $table->insertOne([
        'NIM' => $_POST["NIM"],
        'nama_mahasiswa' => $_POST["nama"],
        'alamat_surel' => $_POST["email"],
        'password' => '12345',
        'role' => $_POST["role"],
        'id_kelas' => $kelas["id_kelas"],
    ]);

    if($addMHS) {
        header("Location: anggota-kelas.php");
    }

?>