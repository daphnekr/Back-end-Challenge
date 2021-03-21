<?php
include("includes/model.php");
$data = getLists();
$status = getStatus();

$listname = $task = $editListname = $editTask ="";
$listnameErr = $taskErr = $editListnameErr = $editTaskErr = "";
$valid = false;

if ($_POST["listname"] != null){
    $listname = test_input($_POST["listname"]);
    
    if (!preg_match("/^[a-zA-Z , ]*$/",$listname)) {
        $listnameErr = " Alleen letters en spaties toegestaan";
    } else {
        $valid = true;
    }
    if ($valid){
        $valid = false;
        createList($listname);
        toIndex();
    }
}
if ($_POST["task"] != null){
    $task = test_input($_POST["task"]);
    
    if (!preg_match("/^[a-zA-Z , ]*$/",$task)) {
        $taskErr = " Alleen letters en spaties toegestaan";
    } else {
        $valid = true;
    }
    if ($valid){
        createTask($_POST["task"], $_POST["listid"]);
        toIndex();
    }
}
if ($_POST["editlistname"] != null){
    $editListname = test_input($_POST["editlistname"]);
    
    if (!preg_match("/^[a-zA-Z , ]*$/",$editListname)) {
        $editListnameErr = " Alleen letters en spaties toegestaan";
    } else {
        $valid = true;
    }
    if ($valid){
        updateList($_POST["editlistname"], $_POST["idlist"]);
        toIndex();
    }
}

if(!empty($_GET["taskid"])){
    deleteTask($_GET["taskid"]); 
    toIndex();
 }
 if($_GET["idlist"] != null){
    deleteList($_GET["idlist"]); 
    toIndex();
 }

 if ($_POST["taskid"] != null){
    $editTask = test_input($_POST["description"]);
    
    if (!preg_match("/^[a-zA-Z , ]*$/",$editTask)) {
        $editTaskErr = " Alleen letters en spaties toegestaan";
    } else {
        $valid = true;
    }
    if ($valid){
        updateTask($_POST["taskid"], $_POST["time"],$_POST["description"], $_POST["status"]);
    }
 }

 function toIndex(){
    header("Location: index.php");
 }


 ?>