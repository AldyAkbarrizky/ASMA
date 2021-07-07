<?php

require_once __DIR__ . "/vendor/autoload.php";

$client = new MongoDB\Client(
    'mongodb+srv://Argonaut:NagisaLaki18@asma.5watn.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');

if(!$client) {
    print "Database Not Connected";
}

// $db = $client->ASMA;
// $tbl = $db->testtable;

// $tbl->insertOne(["Name" => "Aldy Akbarrizky"]);

?>