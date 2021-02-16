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
    $query = $connect->prepare("SELECT * FROM list");
    $query->execute();
    return $query->fetchAll();
}

function getTasks($listid){
    $connect = connectDatabase();
    $query = $connect->prepare("SELECT * FROM tasks WHERE listid = :listid");
    $query->execute(["listid" => $listid]);
    return $query->fetchAll();
}

function createList($listname){
    $connect = connectDatabase();
    $query = "INSERT INTO list (listname) VALUES (:listname)";
    $stmt = $connect->prepare($query);
    $stmt->execute(['listname'=> $listname]);
}

function deleteTask($taskid){
    $connect = connectDatabase();
    $query = $connect->prepare("DELETE FROM tasks WHERE id = :taskid");
    echo "<script>
    alert('Taak is verwijderd.');
    window.location.href='index.php';
    </script>";
    return $query->execute(["taskid" => $taskid]);
    
}

?>