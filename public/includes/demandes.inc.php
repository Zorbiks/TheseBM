<?php

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && isset($_GET["action"])) {
    $id = $_GET["id"];
    $action = $_GET["action"];

    include_once("../classes/models/dbh.class.php");
    include_once("../classes/models/demandes_model.class.php");
    include_once("../classes/controllers/demandes_contr.class.php");

    $demande = new DemandesContr($id);

    if ($action === "accept") {
        $demande->accept();
        header("location: ../demandes-inscription.php?action=accept&error=none");
        exit();
    } elseif("reject") {
        $demande->reject();
        header("location: ../demandes-inscription.php?action=reject&error=none");
        exit();
    }

} else {
    header("location: ../dashboard.php");
    exit();
}