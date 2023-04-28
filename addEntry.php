<?php
    include 'splash.php';
?>
<link href="addEntry.css" rel="stylesheet"/>
<script type="text/javascript" src="/js/cancelForm.js"></script>

</head>


<div class="background">
	<div class="window">
	<form id="addEntryForm" action="includes/addEntry.inc.php" method="post">
        <h1 id="banner">Create Blog Post</h1>

		<input type="text" id="title" name="title" placeholder="Title"><br><br>

        <textarea id="body" name="body" form="addEntryForm" placeholder="Enter text here..."></textarea>

        <button form="addEntryForm" id="post" type="post" name="post">
                <!-- <img src="" alt="arrow"> -->Post
        </button>
        <script type="text/javascript" src="/js/postBlog.js"></script>
        
        <button form="addEntryForm" id="clear" type="button">
                <!-- <img src="" alt="arrow"> -->Clear
        </button>
        <script type="text/javascript" src="/js/clearForm.js"></script>

        <button form="addEntryForm" id="cancel" type="button" onclick="cancelForm();">
                <!-- <img src="" alt="arrow"> -->Cancel
        </button>
	</form>
    </div>
</div>

<?php
    function alertAddEntry($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    if (isset($_GET["error"])){
        if ($_GET["error"] == "emptyInput"){
            alertAddEntry("Fill in all fields!");
        }
        else if ($_GET["error"] == "none"){
            alertAddEntry("Posted!");
        }
        else if ($_GET["error"] == "loggedIn"){
            alertAddEntry("Logged in!");
        }
    }

?>

</html> 