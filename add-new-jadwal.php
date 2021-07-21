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

    $jadwal_senin = $_POST["matkul"];
    $jenis_jadwal_senin = $_POST["jenis_matkul"];
    $jam_awal_senin = $_POST["j_awal"];
    $jam_akhir_senin = $_POST["j_akhir"];

    $jadwal_selasa = $_POST["matkul_selasa"];
    $jenis_jadwal_selasa = $_POST["jenis_matkul_selasa"];
    $jam_awal_selasa = $_POST["j_awal_selasa"];
    $jam_akhir_selasa = $_POST["j_akhir_selasa"];

    $jadwal_rabu = $_POST["matkul_rabu"];
    $jenis_jadwal_rabu = $_POST["jenis_matkul_rabu"];
    $jam_awal_rabu = $_POST["j_awal_rabu"];
    $jam_akhir_rabu = $_POST["j_akhir_rabu"];

    $jadwal_kamis = $_POST["matkul_kamis"];
    $jenis_jadwal_kamis = $_POST["jenis_matkul_kamis"];
    $jam_awal_kamis = $_POST["j_awal_kamis"];
    $jam_akhir_kamis = $_POST["j_akhir_kamis"];

    $jadwal_jumat = $_POST["matkul_jumat"];
    $jenis_jadwal_jumat = $_POST["jenis_matkul_jumat"];
    $jam_awal_jumat = $_POST["j_awal_jumat"];
    $jam_akhir_jumat = $_POST["j_akhir_jumat"];

    $addJadwal = $table->insertOne([
        'semester' => $_POST['Semester'],
        'tahun_ajaran' => $_POST['TA'],
        'id_kelas' => $kelas['id_kelas'],
    ]);

    foreach($jadwal_senin as $key => $jadwal_1) {
        $addSenin = $table->updateOne(
            array('_id' => new MongoDB\BSON\ObjectID($addJadwal->getInsertedId())),
            array('$push' => array('jadwal_senin' => array(
                'id_matkul' => new MongoDB\BSON\ObjectID($jadwal_1),
                'jam_awal' => $jam_awal_senin[$key],
                'jam_akhir' => $jam_akhir_senin[$key],
                'jenis_matkul' => $jenis_jadwal_senin[$key]
            )))
        );
    }

    foreach($jadwal_selasa as $key2 => $jadwal_2) {
        $addSelasa = $table->updateOne(
            array('_id' => new MongoDB\BSON\ObjectID($addJadwal->getInsertedId())),
            array('$push' => array('jadwal_selasa' => array(
                'id_matkul' => new MongoDB\BSON\ObjectID($jadwal_2),
                'jam_awal' => $jam_awal_selasa[$key2],
                'jam_akhir' => $jam_akhir_selasa[$key2],
                'jenis_matkul' => $jenis_jadwal_selasa[$key2]
            )))
        );
    }

    foreach($jadwal_rabu as $key3 => $jadwal_3) {
        $addRabu = $table->updateOne(
            array('_id' => new MongoDB\BSON\ObjectID($addJadwal->getInsertedId())),
            array('$push' => array('jadwal_rabu' => array(
                'id_matkul' => new MongoDB\BSON\ObjectID($jadwal_3),
                'jam_awal' => $jam_awal_rabu[$key3],
                'jam_akhir' => $jam_akhir_rabu[$key3],
                'jenis_matkul' => $jenis_jadwal_rabu[$key3]
            )))
        );
    }

    foreach($jadwal_kamis as $key4 => $jadwal_4) {
        $addKamis = $table->updateOne(
            array('_id' => new MongoDB\BSON\ObjectID($addJadwal->getInsertedId())),
            array('$push' => array('jadwal_kamis' => array(
                'id_matkul' => new MongoDB\BSON\ObjectID($jadwal_4),
                'jam_awal' => $jam_awal_kamis[$key4],
                'jam_akhir' => $jam_akhir_kamis[$key4],
                'jenis_matkul' => $jenis_jadwal_kamis[$key4]
            )))
        );
    }

    foreach($jadwal_jumat as $key5 => $jadwal_5) {
        $addJumat = $table->updateOne(
            array('_id' => new MongoDB\BSON\ObjectID($addJadwal->getInsertedId())),
            array('$push' => array('jadwal_jumat' => array(
                'id_matkul' => new MongoDB\BSON\ObjectID($jadwal_5),
                'jam_awal' => $jam_awal_jumat[$key5],
                'jam_akhir' => $jam_akhir_jumat[$key5],
                'jenis_matkul' => $jenis_jadwal_jumat[$key5]
            )))
        );
    }

    if($addMateri) {
         header("Location: jadwal-kelas.php");
    }

?>