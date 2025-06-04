<?php

// Ensure the form was submitted via POST and the submit button named "submit" has the value "signup"
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]) && $_POST["submit"] === "signup") {
    // Retrieve user input from the signup form
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];

    // Include necessary class files for database connection, model, and controller
    include_once __DIR__ . "/../classes/models/dbh.class.php";
    include_once __DIR__ . "/../classes/models/signup_model.class.php";
    include_once __DIR__ . "/../classes/controllers/signup_contrl.class.php";

    $signup = new SignupContr($firstName, $lastName, $email, $password, $passwordRepeat);

    $signup->signupUser();

    // Redirect to the signup page with a success message in the URL
    header("location: inscription.php?error=none");
    exit();
}