<?php 
include("connection.php");
include("includes/addTask.php");
include("includes/addList.php");
include("includes/functions.php");

$data = getLists();

if(!empty($_GET["id"])){
    deleteTask($_GET["id"]); 
 }
 

?>


<div class="row">
<?php foreach($data as $list){ ?>
    <div class="col-sm bg-light border m-2 p-2">
        
            <h3><?php echo $list["listname"]?> </h3>
            <hr>
            <?php
            $data1 = getTasks($list["id"]);

            foreach($data1 as $task){ 
                echo $task["task"]; ?>  <a href="index.php?id=<?php echo $task["id"];?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');"><i class="fas fa-trash-alt"></i></a> <br> <?php
            }
        ?>
        <form class = "form" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="task" placeholder = "Voeg taak toe"/>
            <input name="listid" type="hidden" value = <?php  echo $list["id"] ?> />
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