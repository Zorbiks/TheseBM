<?php

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && isset($_GET["action"])) {
    $id = $_GET["id"];
    $action = $_GET["action"];

    include_once("../classes/models/dbh.class.php");
    include_once("../classes/models/thesards_mgr_model.class.php");
    include_once("../classes/controllers/thesards_mgr_contr.class.php");

    $manager = new ThesardsMgrContr($id);

    if ($action === "delete") {
        $manager->delete();
        header("location: ../gestion-des-thesards.php?action=delete&error=none");
        exit();
    }

} else {
    header("location: ../dashboard.php");
    exit();
}