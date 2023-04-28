
<?php
    include 'header.php';
?>
<link href="blog.css" rel="stylesheet"/>
<?php
    include 'navigation.php';
?>

    
    <div class="item item-3">
        <h1>Blog</h1>
        
        <?php
            if(isset($_SESSION["usersID"]) && $_SESSION["isAdmin"] === 1){
                $tempName = $_SESSION["usersNAME"];
                echo "<h2>Hi $tempName, please <a href='addEntry.php'>click here</a> to create a new blog entry.</h2>";
            }
            else if (isset($_SESSION["usersID"]) && $_SESSION["isAdmin"]===0){
                $tempName = $_SESSION["usersNAME"];
                echo "<h2>Hi $tempName, feel free to comment on any post.</h2>";
            }
            else{
                echo "<h2>Please <a href='login.php'>log in</a> to create a new blog entry.</h2>";
            }
        ?>
        <form id="monthForm" method="post">
        <!-- <label for="months">Choose a month: </label> -->
        <select id="months" name="months" onchange="this.form.submit()">
        <!-- onchange="this.form.submit();" -->
            <option value="">Filter posts by month...</option>
            <option value="0">None</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>  
        </select>
        </form>     

    </div>
    <div class="item item-4">

        <article class="postsBox">
            <?php include 'includes/findEntry.inc.php';?>
        </article>

    </div>
    <div class="item item-5"></div>
    <div class="item item-6"></div>
    <div class="item item-7"></div>
    <div class="item item-8"></div>
    <div class="item item-9"></div>

</div>
</div>
</body>
</html>