<?php

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && (!isset($_GET["error"]) || $_GET["error"] !== "none")) {
    $action = $_GET["action"];

    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/thesards_mgr_model.class.php";
    include_once __DIR__ . "/../classes/controllers/thesards_mgr_contr.class.php";
    
    if ($action === "delete") {
        $manager = new ThesardsMgrContr($_GET["id"]);
        $manager->delete();
        header("location: gestion-des-thesards.php?action=delete&error=none");
        exit();
    } elseif ($action === "add") {
        $manager = new ThesardsMgrContr($_GET["firstname"], $_GET["lastname"], $_GET["email"], $_GET["password"]);
        $manager->add();
        header("location: gestion-des-thesards.php?action=add&error=none");
        exit();
    }
}