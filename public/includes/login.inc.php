<?php

// Check if this page is accessed the correct way
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]) && $_POST["submit"] === "login") {
    // Grab the submitted data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate the LoginContr class
    include_once("../classes/models/dbh.class.php");
    include_once("../classes/models/login_model.class.php");
    include_once("../classes/controllers/login_contrl.class.php");

    $login = new LoginContr($email, $password);

    // Run error handling and login the user
    $login->loginUser();

    header("location: ../dashboard.php");
    exit();
}