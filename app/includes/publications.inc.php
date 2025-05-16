<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];

    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/publications_model.class.php";
    include_once __DIR__ . "/../classes/controllers/publications_contr.class.php";

    $reference   = $_POST["reference"];
    $titre       = $_POST["titre"];
    $auteurs     = $_POST["auteurs"];
    $lieu        = $_POST["lieu"];
    $doi         = $_POST["doi"];
    $date        = $_POST["date"];
    $type        = $_POST["type"];
    $numero      = $_POST["numero"];
    $volume      = $_POST["volume"];
    $publication = $_FILES["publication"];
    $attestation = $_FILES["attestation"];
    $rapport     = $_FILES["rapport"];
    $thesard_id  = $_SESSION["id"];


    // these input fields are optional, they will be filled with "-" as a placeholder
    if (empty($numero)) {
        $numero = "-";
    }
    if (empty($volume)) {
        $volume = "-";
    }
    if ($action === "add") {
        $pubMgr = new PublicationContr(
            $reference,
            $titre,
            $auteurs,
            $_SESSION["firstName"] . " " . $_SESSION["lastName"],
            $lieu,
            $doi,
            $date,
            $type,
            $numero,
            $volume,
            $publication,
            $attestation,
            $rapport,
            $_SESSION["id"]
        );

        $pubMgr->add();

        header("location: publications.php?action=add&error=none");
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"])) {
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/publications_model.class.php";
    include_once __DIR__ . "/../classes/controllers/publications_contr.class.php";

    $action = $_GET["action"];

    if ($action === "delete" && empty($_GET["error"])) {
        $pubMgr = new PublicationContr($_GET["id"]);
        $pubMgr->delete();
        exit();
    } elseif ($action === "search") {
        if ($_SESSION["role"] === "professeur") {
            $pubMgr = new PublicationContr($_GET["search"], $_GET["filter"]);
            $pubMgr->search();
        } elseif ($_SESSION["role"] === "thesard") {
            $pubMgr = new PublicationContr($_GET["search"], $_GET["filter"], $_SESSION["id"]);
            $pubMgr->search();
        }
        exit();
    }
}