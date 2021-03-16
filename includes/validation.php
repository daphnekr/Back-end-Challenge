<?php
include("includes/model.php");
$data = getLists();
$status = getStatus();

if ($_POST["listname"] != null){
    createList($_POST["listname"]);
    
}
if ($_POST["task"] != null){
    createTask($_POST["task"], $_POST["listid"]);
}
if ($_POST["editlistname"] != null){
    updateList($_POST["editlistname"], $_POST["idlist"]);
    toIndex();
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
    updateTask($_POST["taskid"], $_POST["time"],$_POST["description"], $_POST["status"]);
 }

 function toIndex(){
    header("Location: index.php");
 }
 ?>