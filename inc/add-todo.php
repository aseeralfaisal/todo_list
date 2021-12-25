<?php
session_start();
if (isset($_POST['submit'])) {
    require 'db.php';
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $id = $_SESSION['userid'];


    if (empty($title) || empty($description) || empty($date)) {
        header("Location: ../add.php?error=emptyfields");
        exit();
    } else {
        $sql = "INSERT INTO `todos` (`id`, `title`, `description`, `date`, `user`,`done`) VALUES (NULL, ?, ?, ?, ?,0);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../add.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $title, $description, $date, $id);
            mysqli_stmt_execute($stmt);

            header('Location: ../add.php?added=success');
            header('Location: ../index.php');
            exit();
        }
    }
} else {
    header("Location: ../add.php?error=submit");
    exit();
}
