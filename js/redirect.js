function redirect() {
    var input = document.getElementById("search-query").value;
    
    if ((input.localeCompare("blog") == 0) || (input.localeCompare("blg") == 0)){
            window.location.href = "../blog.php";
        }
    else if ((input.localeCompare("index") == 0) || (input.localeCompare("idx") == 0)){
        window.location.href = "../index.php";
    }
    else if ((input.localeCompare("channel") == 0) || (input.localeCompare("usman16k") == 0)){
        window.location.href = "https://youtube.com/c/usman16k";
    }
    else if ((isValidUrl(input) === true)){
        window.open(input)
    }
    else if (input === ""){
        window.location.reload();
    }
    else{
        //location.href= "../iremote/iremote.html";
        window.open('http://google.com/search?q=' + input);
    }
}

function isValidUrl(string) {
    try {
      new URL(string);
      return true;
    } catch (err) {
      return false;
    }
  }
