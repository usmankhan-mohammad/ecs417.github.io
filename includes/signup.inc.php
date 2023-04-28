<?php

if (isset($_POST["btn"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["xuid"];
    $password = $_POST["xpwd"];
    $pwdRepeat = $_POST["rpwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignUp($name, $email, $username, $password, $pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyInput");
        exit();
    }

    if (invalidUN($username) !== false){
        header("location: ../signup.php?error=invalidUN");
        exit();
    }

    if (invalidEMAIL($email) !== false){
        header("location: ../signup.php?error=invalidEMAIL");
        exit();
    }

    if (pwdMatch($password, $pwdRepeat) !== false){
        header("location: ../signup.php?error=unmatchedPWD");
        exit();
    }

    if (existsUID($conn, $username, $email) !== false){
        header("location: ../signup.php?error=takenUSER");
        exit();
    }

    createUser($conn, $name, $email, $username, $password);

}
else{
    header("location: ../signup.php");
    exit();
}


