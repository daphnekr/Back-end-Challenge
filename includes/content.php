<?php 

// include("includes/addTask.php");
// include("includes/addList.php");
include("includes/functions.php");

$data = getLists();
if ($_POST["listname"] != null){
    createList($_POST["listname"]);
}
if ($_POST["task"] != null){
    createTask($_POST["task"], $_POST["listid"]);
}
if ($_POST["editlistname"] != null){
    updateList($_POST["editlistname"], $_POST["idlist"]);
}

if(!empty($_GET["taskid"])){
    deleteTask($_GET["taskid"]); 
 }
 if($_GET["idlist"] != null){
    deleteList($_GET["idlist"]); 
 }
 

?>


<div class="row">
<?php foreach($data as $list){ ?>
    <div class="col-sm bg-light border m-2 p-2">
        <form class = "form" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <h3 id="title<?php echo $list["listname"] ?>"><?php echo $list["listname"]?> <a id="edittitle" onclick="editTitle('<?php echo $list['listname']?>')" class="text-info"><i class="fas fa-edit fa-xs"></i></a> <a class="text-danger" href="index.php?idlist=<?php echo $list["idlist"];?>" onclick="return confirm('Weet je zeker dat je deze lijst wilt verwijderen?');"><i class="fas fa-trash-alt fa-xs"></i></a></h3>
            <input name="idlist" type="hidden" value= <?php  echo $list["idlist"] ?> />
        </form>
            <hr>
            <?php
            $data1 = getTasks($list["idlist"]);

            foreach($data1 as $task){ 
                ?><a  type="button" class="btn btn-outline-success mb-1" onclick="showtaskdetails(<?php echo $task['taskid']; ?>);"><?php echo $task["task"]; ?></a>  <a class="text-danger" href="index.php?taskid=<?php echo $task["taskid"];?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');"><i class="fas fa-trash-alt"></i></a> <br> 
                <div id= "task<?php echo $task["taskid"]; ?>" style="display: none">
                    <div class="card" id="taskdetails" style="width: 18rem;">
                    <a class="m-1 text-dark" onclick="hidetaskdetails(<?php echo $task['taskid'];?>)" type="button" ><i class="fas fa-times"></i></a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $task['task'];?></h5>
                            <p class="card-text"><?php echo $task['beschrijving'];?></p>
                            <?php if($task['duur'] != null) {?>
                                <p>Duur: <?php echo $task['duur'];?> minuten</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
        <form class = "form mt-2" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="task" placeholder = "Voeg taak toe"/>
            <input name="listid" type="hidden" value = <?php  echo $list["idlist"] ?> />
        </form>
    </div>
    <?php
        }
    ?>
    <div class="col-sm">
        <form class = "form" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="listname" placeholder = "Voeg een nieuwe lijst toe"/>
        </form>
    </div>
</div>
<script src="js/script.js"></script>