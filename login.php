<?php


require_once __DIR__ . "./driver.php";

$database = $client->ASMA;
$table = $database->Mahasiswa;
$table2 = $database->TugasKelas;

$user = $table->findOne(['NIM' => $_POST['NIM']]);
$kelas = $table2->findOne(['id_kelas' => $user['id_kelas']]);
if($user) {
    $pass = $user['password'];
    if($_POST['password'] == $pass){
        // echo "Berhasil Login";
        session_start();
        $_SESSION["Nama"] = $user["nama_mahasiswa"];
        $_SESSION["NIM"] = $user["NIM"];
        $_SESSION["Role"] = $user["role"];
        $_SESSION["Kelas"] = $kelas["kelas"];
        header("Location: index.php");
    } else {
        // echo "Password salah";
        header("Location: authentication-login.php");
    }
} else {
    // echo "User tidak ditemukan";
    header("Location: authentication-login.php");
}
?>