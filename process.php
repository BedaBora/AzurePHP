<?php

session_start();
$host='sqlserver-crimson.mysql.database.azure.com';
$username= 'user1@sqlserver-crimson';
$password= 'Password@123'; 
$db='tasks';

$conn=mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db, 3306);
if (mysqli_connect_errno($conn)) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}

if(isset($_POST['save'])){
    $task = $_POST['task'];
    $due =$_POST['completion'];
    
    if($insertQuery= mysqli_prepare($conn, "INSERT INTO all_tasks (Name, Due) VALUES(?,?)")){
        mysqli_stmt_bind_param($insertQuery, 'ss', $task, $due);
        mysqli_stmt_execute($insertQuery);
    }

    $_SESSION['message']= "Record has been saved!";
    $_SESSION['msg_type']= "success";

    header("location: index.php");

}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    if($insertQuery= mysqli_prepare($conn, "DELETE FROM all_tasks WHERE Id=?")){
        mysqli_stmt_bind_param($insertQuery, 's', $id, );
        mysqli_stmt_execute($insertQuery);
    }

    $_SESSION['message']= "Record has been deleted!";
    $_SESSION['msg_type']= "danger";

    header("location: index.php");
}

?>