 const edittiltle = document.getElementById("edittitle");

 function editTitle(listname){
    const title = document.getElementById("title"+listname);
    var input = document.createElement('INPUT');
    input.setAttribute("value", listname);
    input.setAttribute("name", "editlistname");
    title.parentNode.replaceChild(input, title);
}

function showtaskdetails(taskid){
    const task = document.getElementById("task"+taskid);
    task.style.display = "block";
    
}
function hidetaskdetails(taskid){
    const task = document.getElementById("task"+taskid);
    task.style.display = "none";
}

 document.onkeydown=function(evt){
    var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
    if(keyCode == 13)
    {
        document.test.submit();
    }
}


