<?php

if(isset($_GET['id'])){
    require 'db.php';
    $id = $_GET['id'];
    $sql = "UPDATE `todos` SET `done` = 1 WHERE `id` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php?done=success');
        exit(); 
    }
    
}
else{
    header("Location: ../index.php?error=submit");
        exit();
}