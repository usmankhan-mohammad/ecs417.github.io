<?php

///SIGNING UP


function emptyInputSignUp($name, $email, $username, $password, $pwdRepeat){
    $result = false;
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($pwdRepeat)){
        $result = true;
    }

    return $result;

}

function invalidUN($username){
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }

    return $result;

}

function invalidEMAIL($email){
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }

    return $result;

}

function pwdMatch($password, $pwdRepeat){
    $result = false;
    if ($password !== $pwdRepeat) {
        $result = true;
    }

    return $result;

}

function existsUID($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEMAIL = ?;";
    $prep = mysqli_stmt_init($conn); //prepared statement for security

    if (!mysqli_stmt_prepare($prep, $sql)){
        header("location: ../signup.php?error=prepFAIL");
        exit();
    }

    mysqli_stmt_bind_param($prep, "ss", $username, $email); //parameters are two strings (ss)
    mysqli_stmt_execute($prep);

    $grab = mysqli_stmt_get_result($prep);

    if ($row = mysqli_fetch_assoc($grab)){ //if any data is grabbed, return true
        //alternate purpose for logging in
        mysqli_stmt_close($prep);
        return $row;
    }
    else {
        //alternate purpose for signing up
        $result = false;
        mysqli_stmt_close($prep);
        return $result;
    }

    
    
}

function createUser($conn, $name, $email, $username, $password){
    $sql = "INSERT INTO users (usersNAME, usersEMAIL, usersUid, usersPwd, isAdmin) VALUES (?,?,?,?,?) ;";
    $prep = mysqli_stmt_init($conn); //prepared statement for security

    if (!mysqli_stmt_prepare($prep, $sql)){
        header("location: ../signup.php?error=prepFAIL");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);//hash password so it is not visible in the database
    $notAdmin = 0;
    mysqli_stmt_bind_param($prep, "ssssi", $name, $email, $username, $hashedPwd, $notAdmin); //parameters are four strings (ssss)
    mysqli_stmt_execute($prep);
    mysqli_stmt_close($prep);
    header("location: ../login.php?error=none");
    exit();

    
}

////LOGGING IN

function emptyInputLogIn($username, $password){
    $result = false;
    if (empty($username) || empty($password)){
        $result = true;
    }

    return $result;

}

function loginUser($conn, $username, $password){
    $uidExists = existsUID($conn, $username, $username); //no need to differentiate between username and email: if given an username/email, one of the OR statements in existsUID will equal true

    if ($uidExists === false){
        header("location: ../login.php?error=missingUID");
        exit();
    }

    $hashedPwd = $uidExists["usersPwd"]; //$uidExists is an assoc. array, so this takes the data from the row $uidExists at column ["users"]

    if (!password_verify($password, $hashedPwd)){
        header("location: ../login.php?error=incorrectPwd");
        exit();
    }
    else if (password_verify($password, $hashedPwd)){
        session_start();
        $_SESSION["usersID"] = $uidExists["usersID"];
        $_SESSION["usersUid"] = $uidExists["usersUid"];
        $_SESSION["usersNAME"] = $uidExists["usersNAME"];
        $_SESSION["isAdmin"] = $uidExists["isAdmin"];
        if($uidExists["isAdmin"] === 1){
            header("location: ../addEntry.php?error=loggedIn");
        }
        else{
            header("location: ../index.php?error=none");
        }
        
        exit();
    }
}

