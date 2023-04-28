<?php

//POSTING TO BLOG

//use preventDefault() and highlight using css styles

session_start();

function emptyInputBlog($title, $body){
    $result = false;
    if (empty($title) || empty($body)){
        $result = true;
    }

    return $result;

}

function existsPID($conn, $title, $date){
    $sql = "SELECT * FROM posts WHERE postTitle = ? OR postDATE = ?;";
    $prep = mysqli_stmt_init($conn); //prepared statement for security

    if (!mysqli_stmt_prepare($prep, $sql)){
        header("location: ../addEntry.php?error=prepFAIL");
        exit();
    }

    mysqli_stmt_bind_param($prep, "ss", $title, $date); //parameters are two strings (ss)
    mysqli_stmt_execute($prep);

    $grab = mysqli_stmt_get_result($prep);

    if ($row = mysqli_fetch_assoc($grab)){ //if any data is grabbed, return true
        //alternate purpose for getting from blog
        mysqli_stmt_close($prep);
        return $row;
    }
    else {
        //alternate purpose for adding to blog
        $result = false;
        mysqli_stmt_close($prep);
        return $result;
    }

    
}


function addToBlog($conn, $title, $body){
    
    if($_SESSION["isAdmin"] === 1){
        $sql = "INSERT INTO posts (postTitle, postContents) VALUES (?,?) ;";
        $prep = mysqli_stmt_init($conn); //prepared statement for security
    
        if (!mysqli_stmt_prepare($prep, $sql)){
            header("location: ../addEntry.php?error=prepFAIL");
            exit();
        }
    
    
        mysqli_stmt_bind_param($prep, "ss", $title, $body); //parameters are three strings (sss)
        mysqli_stmt_execute($prep);
        mysqli_stmt_close($prep);
        header("location: ../addEntry.php?error=none");
        exit();
    }
    else{
        $tmp = $_SESSION['isAdmin'];
        echo("You do not have the ability to post (SESSION[isAdmin]=$tmp");
    }

    
}



// function getFromBlog($conn, $title, $date){
//     $pidExists = existsPID($conn, $title, $date); //no need to differentiate between title and body: if given an title/body, one of the OR statements in existsUID will equal true

//     if ($pidExists === false){
//         header("location: ../blog.php?error=missingUID");
//         exit();
//     }
//     //reload blog
//     else{
//         $_SESSION["postTitle"] = $pidExists["postTitle"];
//         $_SESSION["postContents"] = $pidExists["postContents"];
//         $_SESSION["postDate"] = $pidExists["postDate"];
//         header("location: ../blog.php?error=none");
//         exit();
//     }
// }

function findEntry($conn){
        $sql = "SELECT * FROM `posts`;";
        $result = $conn->query($sql); //create associated array

        $rows = []; //empty array
        while($row = mysqli_fetch_array($result)){ //for each row
            $rows[] = $row; //create array of rows
        }
        usort($rows, "cmp");// merge sort array of rows by date

        $numrows = count($rows); //get number of rows in rows
        $reversedrows = array_reverse($rows); //reverse rows to be descending
        
        if ($numrows > 0){
            // output data of each row
            $i = 0;

            foreach($reversedrows as $row) { //for each row in the reversed sorted rows
                
                $i = $i + 1; //allows me to target specific posts in css
                $tempDate = $row["postDate"]; //get the postDate

                $dt = new DateTime();
                $dt->setTimezone(new DateTimeZone('UTC'));
                $dt->setTimestamp(strtotime($tempDate)); //convert to UTC
                $newDate = $dt->format('jS \of F Y\, G:i T'); //create string of correct format

 
                $tempTitle = $row["postTitle"]; //get title
                $tempBody = $row["postContents"]; //get body
                $tempID = $row["postID"]; //get ID for comments
               
                //echo the date, title and body and name the class post post-i where i is the targeted post's number position to other posts shown on blog
                echo "<div class='posts post-$i'>
                        <h2 class='title'>
                            $tempTitle
                        </h2>
                        <p class='body'>
                            $tempBody
                        </p>
                        <aside class='date'>
                            <em>$newDate</em>
                        </aside>
                        <br>
                        <hr class='cLine'>";
                        findComments($conn, $tempID, $i);
                    echo"
                        </div>
                        <hr class='line'>";
            }
        } 
        else {
            echo "<div class='posts noPost'>
                There have been no blog entries yet.
            </div>
            <hr class='line'>";
        }
}

function cmp($a, $b){ //comparison function
    return strcmp($a["postDate"], $b["postDate"]); //by date
}

function cmpC($a, $b){ //comparison function
    return strcmp($a["commentDate"], $b["commentDate"]); //by date
}



function findComments($conn, $postID, $i){
    $sql = "SELECT * FROM `comments` WHERE postID = $postID;";
    $result = $conn->query($sql); //create associated array

    $rows = []; //empty array
    while($row = mysqli_fetch_array($result)){ //for each row
        $rows[] = $row; //create array of rows
    }
    usort($rows, "cmpC");// merge sort array of rows by date

    $numrows = count($rows); //get number of rows in rows


    if(isset($_SESSION["usersID"])){
        $currentUsersID = $_SESSION["usersID"];
    }
    else{
        $currentUsersID = 'none';
    }


    if ($numrows > 0){
        // output data of each row
        $c = 0;
        
        foreach($rows as $row) { //for each row in the reversed sorted rows
            
            $c = $c + 1; //allows me to target specific posts in css, also acts a counter
            $tempDate = $row["commentDate"]; //get the postDate

            $dt = new DateTime();
            $dt->setTimezone(new DateTimeZone('UTC'));
            $dt->setTimestamp(strtotime($tempDate)); //convert to UTC
            $newDate = $dt->format('jS \of F Y\, G:i T'); //create string of correct format


            
            $tempBody = $row["commentContents"]; //get body
            $tempUsersID = $row["usersID"]; //get usersID


            $tempName = getName($conn, $tempUsersID);//get username

            $cmntID = $row["commentID"];
            

            if ($c != $numrows){ //prevents comment box from being displayed below each comment
                echo "<div class='posts post-$i comments comment-$c index-$i-$c'>
                    <h3 class='cmntTitle'>
                        $tempName on the $newDate commented: 
                    </h2>
                    <p class='cmntBody'>
                        $tempBody
                    </p>";

                    //ADD DELETE BUTTON
                if ($_SESSION['isAdmin'] === 1){
                    echo 
                    "<form class='dltCommentBox' id='dltCommentForm-$i' method='post' action='includes/dltComment.inc.php'>
                    
                    <button class='dltBtn' form='dltCommentForm-$i' id='cmntDlt' name='cmntDlt' type='post'>
                        <!-- <img src='' alt='arrow'> -->Delete
                    </button>
            
            
                    <input type='hidden' form='dltCommentForm-$i' id='cmntID' name='cmntID' value='$cmntID' />
            
                    </form>


                    
                    </div>";
                }
                else{
                    echo 
                    "
                    </div>";
                }
            }
            else{
                echo "<div class='posts post-$i comments comment-$c index-$i-$c'>
                    <h3 class='cmntTitle'>
                        $tempName on the $newDate commented: 
                    </h2>
                    <p class='cmntBody'>
                        $tempBody
                    </p>";

                if ($_SESSION['isAdmin'] === 1){
                    echo 
                    "<form class='dltCommentBox' id='dltCommentForm-$i' method='post' action='includes/dltComment.inc.php'>
                    
                    <button class='dltBtn' form='dltCommentForm-$i' id='cmntDlt' name='cmntDlt' type='post'>
                        <!-- <img src='' alt='arrow'> -->Delete
                    </button>
            
            
                    <input type='hidden' form='dltCommentForm-$i' id='cmntID' name='cmntID' value='$cmntID' />
            
                    </form>


                    ";
                }
                else{
                    echo 
                    "";
                }
                echo "</div>
                    <div class='commentBox'>";
                    
                displayCommentBox($currentUsersID, $postID, $i);

                echo "</div>
                ";
            }      
            

        }
    } 
    else {
        echo "<div class='posts post-$i comments noComment'>
            There have been no comments yet.
        </div>";
        displayCommentBox($currentUsersID, $postID, $i);
    }

}

function getName($conn, $usersID){
    $sql = "SELECT usersName FROM `users` WHERE usersID = $usersID;";
    $result = $conn->query($sql); //create associated array

    $rows = []; //empty array
    while($row = mysqli_fetch_array($result)){ //for each row
        $rows[] = $row; //create array of rows
    }

    $numrows = count($rows);

    if ($numrows === 1){
        return $rows[0]['usersName'];
    }
    else{
        return "ERROR";
    }
}

function displayCommentBox($usersID, $postID, $i){
    if ($usersID != 'none'){
        //make a button, once this button is clicked on, the global session variable of postID is set, and the html for adding a comment reveals itself
        // echo"<input type='submit' name='startComment'>";
        // echo "postID: $postID";
        // echo "<br>";
        // echo "usersID: $usersID";
        echo
        "<form class='comments addCommentBox' id='addCommentForm-$i' method='post' action='includes/addComment.inc.php'>

        <textarea class='cmnt cmnt-txt' id='cmntInput' name='cmntInput' form='addCommentForm-$i' placeholder='Enter comment here...'></textarea>

        <button class='cmnt cmnt-btn' form='addCommentForm-$i' id='cmntSubmit' name='cmntSubmit' type='post'>
                <!-- <img src='' alt='arrow'> -->Comment
        </button>


        <input type='hidden' form='addCommentForm-$i' id='postID' name='postID' value='$postID' />
        <input type='hidden' form='addCommentForm-$i' id='usersID' name='usersID' value='$usersID' />

	    </form>
        <br>";


    }
    else{
        echo "<aside class='comments notice'>
        Please <a href='login.php'>log in</a> to comment.
        </aside>";
    }
}



function commentToPost($conn, $postID, $usersID, $body){

    $sql = "INSERT INTO comments(postID,usersID,commentContents) VALUES (?,?,?) ;";

    $prep = mysqli_stmt_init($conn); //prepared statement for security

    if (!mysqli_stmt_prepare($prep, $sql)){
        header("location: ../blog.php?error=prepFAIL");
        exit();
    }

    

    mysqli_stmt_bind_param($prep, "iis", $postID, $usersID, $body); //parameters are 2 ints, 1 strings (iisi)
    mysqli_stmt_execute($prep);
    mysqli_stmt_close($prep);
    header("location: ../blog.php?error=none");
    exit();




}


function deleteComment($conn, $cmntID){
    $sql = "DELETE FROM `comments` WHERE `comments`.`commentID` = $cmntID;";

    if ($conn->query($sql) === TRUE){
        header("location: ../blog.php?error=none");
    }
    else{
        header("location: ../blog.php?error=ERROR");
    }


}





function findEntryByMonth($conn, $month){
    $sql = "SELECT * FROM `posts` WHERE MONTH(postDate) = $month;"; //specifies month 
    $result = $conn->query($sql); //create associated array

    $rows = []; //empty array
    while($row = mysqli_fetch_array($result)){ //for each row
        $rows[] = $row; //create array of rows
    }
    usort($rows, "cmp");// merge sort array of rows by date

    $numrows = count($rows); //get number of rows in rows
    $reversedrows = array_reverse($rows); //reverse rows to be descending
    
    if ($numrows > 0){
        // output data of each row
        $i = 0;

        foreach($reversedrows as $row) { //for each row in the reversed sorted rows
            
            $i = $i + 1; //allows me to target specific posts in css
            $tempDate = $row["postDate"]; //get the postDate

            $dt = new DateTime();
            $dt->setTimezone(new DateTimeZone('UTC'));
            $dt->setTimestamp(strtotime($tempDate)); //convert to UTC
            $newDate = $dt->format('jS \of F Y\, G:i T'); //create string of correct format


            $tempTitle = $row["postTitle"]; //get title
            $tempBody = $row["postContents"]; //get body
            $tempID = $row["postID"]; //get ID for comments
           
            //echo the date, title and body and name the class post post-i where i is the targeted post's number position to other posts shown on blog
            echo "<div class='posts post-$i'>
                    <h2 class='title'>
                        $tempTitle
                    </h2>
                    <p class='body'>
                        $tempBody
                    </p>
                    <aside class='date'>
                        $newDate
                    </aside>
                    <hr class='line'>";
                    findComments($conn, $tempID, $i);
                echo"<hr class ='line'>
                    </div>";
        }
    } 
    else {
        echo "<div class='posts noPost'>
            There have been no blog entries yet.
        </div>";
    }
}