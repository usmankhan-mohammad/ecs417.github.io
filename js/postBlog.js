document.getElementById('post').addEventListener("click", function(event){
    // alert("LINKED");
    var title = document.getElementById("title").value;
    var titleHL = document.getElementById("title");
    var body = document.getElementById("body").value;
    var bodyHL = document.getElementById("body");
    if (!title || !body){
        event.preventDefault();
        alert("Fill in all fields!");
        
        if (!title){
            titleHL.classList.add('hl');
        }
        if (!body){
            bodyHL.classList.add('hl');
        }
    }
});