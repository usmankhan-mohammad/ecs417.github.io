document.getElementById('clear').addEventListener("click", function(event){
    // alert("LINKED");
    event.preventDefault();
    var title = document.getElementById("title").value;
    var body = document.getElementById("body").value;
    if (!title && !body){
        alert("No text to clear.")
    }
    else{
        if (confirm("Do you want to clear all text?")){
            window.location.href = "../addEntry.php?error=clearedPrev";
        }
    }
});

