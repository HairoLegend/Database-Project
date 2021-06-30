<?php
session_start();
include "database.php";

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "DELETE FROM $table WHERE id='$id'";

// To check if has modified something or not, if yes then prevent from being deleted.
if ($table == 'admin') {
    $admin = $conn->query("SELECT name FROM $table WHERE id='$id'")->fetch_assoc();
    $adminName = $admin['name'];

    $lecturer = $conn->query("SELECT Modified_by FROM lecturer WHERE Modified_by = '$adminName'")->fetch_assoc();
    $student = $conn->query("SELECT Modified_by FROM student WHERE Modified_by = '$adminName'")->fetch_assoc();
    $subject = $conn->query("SELECT Modified_by FROM subject WHERE Modified_by = '$adminName'")->fetch_assoc();
    if (($lecturer['Modified_by'] != NULL) || ($student['Modified_by'] != NULL) || ($subject['Modified_by'] != NULL) || ($id == '1')) {
        $conn->close();
        echo "Delete Unsuccessful <br> Admin ('$adminName') is being used at other tables";
        if ($id == '1') 
        echo  "Bruh, you can't delete that admin la..";
        echo "Fail"; 
        header("location:admin/adminRA.php");
        die();
    }
}

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record ('$table, $id')  deleted successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    if ($conn->errno == '1451') {
        $_SESSION['msg'] = ucfirst($table) . " ID ($id) is being used at other tables.";
    } else
        $_SESSION['msg'] = "$sql  <br> $conn->error <br> $conn->errno";
    $_SESSION['status'] = "Fail";
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
