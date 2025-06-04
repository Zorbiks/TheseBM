<?php

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && isset($_GET["action"])) {
    $id = $_GET["id"];
    $action = $_GET["action"];

    include_once __DIR__ . "/../classes/services/MailService.php";
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/demandes_model.class.php";
    include_once __DIR__ . "/../classes/controllers/demandes_contr.class.php";

    $demande = new DemandesContr($id);

    if ($action === "accept") {
        $demande->accept();
        header("location: demandes-inscription.php?action=accept&error=none");
        exit();
    } elseif($action === "reject") {
        $demande->reject();
        header("location: demandes-inscription.php?action=reject&error=none");
        exit();
    }
}