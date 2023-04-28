<?php
    include 'splash.php';
?>
<link href="login.css" rel="stylesheet"/>
</head>

<div class="background">
	<div class="window">
	<form id="signupForm" action="../includes/signup.inc.php" method="post">
        <br>
        <h1>Sign Up</h1>

        <input type="text" name="name" id="name" placeholder="Full Name" size="50">
        <br>
        <input type="text" name="email" id="email" placeholder="Email Address" size="50">
        <br>
        <input type="text" name="xuid" id="xuid" placeholder="Username" size="50">
        <br>
        <input type="password" name="xpwd" id="xpwd" placeholder="Password" size="50">
        <br>
        <input type="password" name="rpwd" id="rpwd" placeholder="Repeat Password" size="50">
        <br>
        <button form="signupForm" name="btn" id="btn" type="submit" name="submit">Submit</button>
	</form>
    </div>
</div>

<?php
        function alertSignUp($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }

        if (isset($_GET["error"])){
            if ($_GET["error"] == "emptyInput"){
                alertSignUp("Fill in all fields!");
            }
            else if ($_GET["error"] == "invalidUN"){
                alertSignUp("Please enter a valid username.");
            }
            else if ($_GET["error"] == "invalidEMAIL"){
                alertSignUp("Please enter a valid email address.");
            }
            else if ($_GET["error"] == "unmatchedPWD"){
                alertSignUp("Passwords do not match.");
            }
            else if ($_GET["error"] == "takenUSER"){
                alertSignUp("This username has been taken. Please try another.");
            }
            else if ($_GET["error"] == "prepFAIL"){
                alertSignUp("Something went wrong. Please try again.");
            }
            else if ($_GET["error"] == "none"){
                alertSignUp("You have signed up!");
            }
        }
    
?>
<div class="item item-4">
    
</div>

<!--<div class="item item-5"></div>
<div class="item item-6"></div>
<div class="item item-7"></div>
<div class="item item-8"></div>
<div class="item item-9"></div>-->
    
</div>
</div>
</body>
</html>