</head>
    <body>
    <div class="window">
    <div class="gridLayout">
    
        <nav class="item item-1">
            <a class='element element-1'><img id="back-arrow" src="images/back-arrow.png" alt="arrow" onclick="history.back()"></a>
            <a class='element element-2'><img id="arrow" src="images/arrow.png" alt="arrow" onclick="redirect()"></a>
            

            <form class="element element-3">    
            <input type="text" name="search-bar" id="search-query" placeholder="Type in an address">
            <script type="text/javascript" src="../js/enterSearch.js"></script>
            </form>
    
            <!--This should change if there is an active session or not-->
            <?php
            if(isset($_SESSION["usersID"])){
                echo "<a class='element element-4' href='blog.php'><img src='images/blog.png' alt='blog-button' id='blogbtn'></a>";
                echo "<a class='element element-5' href='includes/logout.inc.php'><img src='images/userIn.png' id='userIn' alt='logout-button'></a>";
            }
            else{
                echo "<a class='element element-4' href='blog.php'><img src='images/blog.png' alt='blog-button' id='blogbtn'></a>";
                echo "<a class='element element-5' href='login.php'><img src='images/userOut.png' id='userOut' alt='login-button'></a>";
            }
            ?>
            
            
        </nav>
    
        <!--<div class="item item-2"></div>-->