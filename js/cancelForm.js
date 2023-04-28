// function resetForm() {
//     var title = document.getElementById("title").value;
//     var body = document.getElementById("body").value;
    
//     if (!title && !body){
//         return true;
//     }
//     else{
//     return confirm("Are you sure you want to clear all text?");
//     }
    
// }

function cancelForm() {
    var title = document.getElementById("title").value;
    var body = document.getElementById("body").value;
    let leave = false;
    if (!title && !body){
        window.location.href = "../blog.php";
    }
    else{
        leave = confirm("Are you sure you want to cancel?");
    }
    
    if (leave === true){
        location.href = "../blog.php";
    }
}

