<!DOCTYPE html>
<html>
    <head>
        <title>TO DO LIST</title>
        <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            img{
                height: 50%;
                width: 50%;
            }
        </style>
   
    </head>
    <body background="#5691f0">
        <?php require_once 'process.php'; ?>

        <?php 
            if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>

        <div class="container">
            <img src="https://crimsonstore.z13.web.core.windows.net/to-do.jpg" class="mx-auto d-block">
        <h3>To Do List</h3>
            <!-- Connect to PHP -->
            <?php
                $host='sqlserver-crimson.mysql.database.azure.com';
                $uname= 'user1@sqlserver-crimson';
                $password= 'Password@123'; 
                $db='tasks';
                
                $conn=mysqli_init();
                mysqli_real_connect($conn, $host, $uname, $password, $db, 3306);
                if (mysqli_connect_errno($conn)) {
                    die('Failed to connect to MySQL: '.mysqli_connect_error());
                }
                $result=  mysqli_query($conn, "SELECT * FROM all_tasks") or die(mysqli_error($conn));
            ?>
        <!--------------->
        
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Due Date</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                        while($row= $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Due']; ?></td>
                            <td>
                                <a href="process.php?delete=<?php echo $row['Id']; ?>"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <?php
                function pre_r($array){
                    echo '<pre>';
                    print_r($array);
                    echo '</pre>';
                }
            ?>

            <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <div class="form-group">
                <label>Task</label>
                <input type="text" name="task" class="form-control" placeholder="Enter the task" >
                </div>

                <div class="form-group">
                <label>Due Date</label>
                <input type="text" name="completion" class="form-control" placeholder="Enter due date">
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary" name="save">Save</button>
                </div>
            </form>
            </div>
        </div>
    </body>
</html>