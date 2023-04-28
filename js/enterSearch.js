var inputEvent = document.getElementById('search-query');
inputEvent.addEventListener("keypress", function(event){
    if (event.key === "Enter") {
        event.preventDefault();
        redirect();
    }
});

