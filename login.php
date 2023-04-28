<?php
    include 'splash.php';
?>
<link href="login.css" rel="stylesheet"/>
</head>

<div class="background">
	<div class="window">
	<form id="loginForm" action="includes/login.inc.php" method="post">
        <br>
        <h1>Log In</h1>

		<input type="text" id="uid" name="uid" placeholder="Username/Email"><br>
		<input type="password" id="pwd" name="pwd" placeholder="Password"><br>

        <button form="loginForm" id="btn" type="submit" name="submit">
            <!-- <img src="" alt="arrow"> -->Submit
        </button>
        <br><br>
        <button id="btn2">No account? Click here to sign up.</button>

	</form>
    </div>
</div>

<?php
    function alertLogIn($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    if (isset($_GET["error"])){
        if ($_GET["error"] == "emptyInput"){
            alertLogIn("Fill in all fields!");
        }
        else if ($_GET["error"] == "incorrectPwd"){
            alertLogIn("Incorrect password.");
        }
        else if ($_GET["error"] == "missingUID"){
            alertLogIn("Username/Email does not exist.");
        }
        else if ($_GET["error"] == "none"){
            alertLogIn("You have signed up!");
        }
    }

?>

</body>
</html> 


