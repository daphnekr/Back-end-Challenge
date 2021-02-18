<?php 
function connectDatabase(){
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = 'back-end-challenge';
    $connection = null;


    try {
        $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connect;

    }
    catch(PDOException $e)
        {
        $e->getMessage();
        }
}

function getLists(){
    $connect = connectDatabase();
    $query = $connect->prepare("SELECT id AS idlist, listname FROM list");
    $query->execute();
    return $query->fetchAll();
}

function getTasks($listid){
    $connect = connectDatabase();
    $query = $connect->prepare("SELECT id AS taskid, listid, task, beschrijving, duur FROM tasks WHERE listid = :listid");
    $query->execute(["listid" => $listid]);
    return $query->fetchAll();
}

function createList($listname){
    $connect = connectDatabase();
    $query = "INSERT INTO list (listname) VALUES (:listname)";
    $stmt = $connect->prepare($query);
    $stmt->execute(['listname'=> $listname]);
    echo "<script>
    window.location.href='index.php';
    </script>";
}

function createTask($task, $listid){
    $connect = connectDatabase();
    $sql = "INSERT INTO tasks (listid, task) VALUES (:listid, :task)";
    $stmt = $connect->prepare($sql);
    $stmt->execute(['listid'=> $listid, 'task'=> $task]);
}

function deleteTask($taskid){
    $connect = connectDatabase();
    $query = $connect->prepare("DELETE FROM tasks WHERE id = :taskid");
    echo "<script>
    window.location.href='index.php';
    </script>";
    return $query->execute(["taskid" => $taskid]);
}
function deleteList($listid){
    $connect = connectDatabase();
    $query = $connect->prepare("DELETE FROM list WHERE id = :listid");
    $query1 = $connect->prepare("DELETE FROM tasks WHERE listid = :listid");
    echo "<script>
    window.location.href='index.php';
    </script>";
    $query1->execute(["listid" => $listid]);
    return $query->execute(["listid" => $listid]);
}
function getList($id){
    $connect = connectDatabase();
    $data = $connect->prepare("SELECT * FROM list WHERE list.id = :id");
    $data->execute(['id' => $id]);
    return $data->fetch();
}

function updateList($listname, $id){
    $connect = connectDatabase();
    $data = $connect->prepare("UPDATE list SET listname = :listname WHERE id = :id");
    $data->execute(['listname' => $listname,'id' => $id]);
    echo "<script>
    window.location.href='index.php';
    </script>";
}

?>