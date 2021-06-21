<?php
session_start();
include "database.php";

$id = $_GET['id'];
$table = $_GET['table'];
$name = $_GET['name'];
$currentUser = $_SESSION['userName'];
date_default_timezone_set("Asia/Kuala_Lumpur");
$currentTime = date("Y-m-d h:i:s");

if ($table == 'lecturer' || $table == 'student'  || $table == 'subject')
    $sql = "UPDATE $table SET name='$name', Modified_by='$currentUser', Date_modified='$currentTime' WHERE id='$id'";
else
    $sql = "UPDATE $table SET name='$name' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
   echo "Success";
    $conn->close();
} else {
   echo "Error updating record: " . $conn->error;
   
}

if ($table == "admin")
    header("location:admin/adminRA.php");
else if ($table == "lecturer")
    header("location:admin/adminRL.php");
else if ($table == "student")
    header("location:admin/adminRS.php");
else if ($table == "subject")
    header("location:admin/adminRSub.php");
else
    header("location:index.php");
