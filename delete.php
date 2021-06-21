<?php
session_start();
include "database.php";

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "DELETE FROM $table WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Success";
    $conn->close();
} else {
    echo "Error deleting record: " . $conn->error;
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
    header("location:/index.php");
