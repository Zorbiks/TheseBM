<?php

// Check if this page is accessed the correct way
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]) && $_POST["submit"] === "signup") {
    // Grab the submitted data
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];

    // Instantiate the SignupContr class
    include_once("../classes/models/dbh.class.php");
    include_once("../classes/models/signup_model.class.php");
    include_once("../classes/controllers/signup_contrl.class.php");

    $signup = new SignupContr($firstName, $lastName, $email, $password, $passwordRepeat);

    // Run error handling and sign up the user
    $signup->signupUser();

    header("location: ../inscription.php?error=none");
    exit();
}