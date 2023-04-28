<?php

if (isset($_POST["cmntDlt"])){
    
    $cmntID = $_POST["cmntID"];

    require_once 'dbh.inc.php';
    require_once 'functionsBlog.inc.php';

    if (emptyInputBlog($cmntID, $cmntID) !== false){
        header("location: ../blog.php?error=emptyInput");
        exit();
    }

    deleteComment($conn, $cmntID);

}
else{
    header("location: ../blog.php");
    exit();
}

    // $postID = $_POST["postID"];
    // $usersID = $_POST["usersID"];
    // $body = $_POST["cmntInput"];
    // echo "usersID: $usersID";
    // echo "postID: $postID";
    // $body = $_POST["cmntInput"];
    // echo "text: $body";
    // echo $_SESSION["isAdmin"];