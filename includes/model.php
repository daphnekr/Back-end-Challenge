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

function getTasks($listid, $sortTask, $order){
    $connect = connectDatabase();
    if ($order == null){
        $order = "";
    }
    if ($sortTask == null){
        $query = $connect->prepare("SELECT tasks.id AS taskid, listid, task, description, time, status.id AS statusid, status.status AS status FROM tasks INNER JOIN status on tasks.status = status.id WHERE listid = :listid");
        $query->execute(["listid" => $listid]);
    } else {
        $query = $connect->prepare("SELECT tasks.id AS taskid, listid, task, description, time, status.id AS statusid, status.status AS status FROM tasks INNER JOIN status on tasks.status = status.id WHERE listid = $listid $sortTask $order");
        $query->execute();
    }
    return $query->fetchAll();
}

function createList($listname){
    $connect = connectDatabase();
    $query = "INSERT INTO list (listname) VALUES (:listname)";
    $stmt = $connect->prepare($query);
    $stmt->execute(['listname'=> $listname]);

}

function createTask($task, $listid){
    $connect = connectDatabase();
    $sql = "INSERT INTO tasks (listid, task, status) VALUES (:listid, :task, 1)";
    $stmt = $connect->prepare($sql);
    $stmt->execute(['listid'=> $listid, 'task'=> $task]);
}

function deleteTask($taskid){
    $connect = connectDatabase();
    $query = $connect->prepare("DELETE FROM tasks WHERE id = :taskid");
    return $query->execute(["taskid" => $taskid]);
}
function deleteList($listid){
    $connect = connectDatabase();
    $query = $connect->prepare("DELETE FROM list WHERE id = :listid");
    $query1 = $connect->prepare("DELETE FROM tasks WHERE listid = :listid");
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
}

function updateTask($taskid, $time, $description, $status){
    $connect = connectDatabase();
    $sql = "UPDATE tasks SET time = :time, description = :description, status = :status WHERE id = :taskid ";
    $stmt = $connect->prepare($sql);
    $stmt->execute(['taskid'=> $taskid, 'time'=> $time, 'description'=> $description, 'status'=> $status]);
}

function getStatus(){
    $connect = connectDatabase();
    $query = $connect->prepare("SELECT * FROM status");
    $query->execute();
    return $query->fetchAll();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>