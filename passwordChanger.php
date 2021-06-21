<?php
    session_start();
    include('database.php');

    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $sql = "UPDATE " . $_SESSION['userTable'] . " SET password = '$password' WHERE id = '" . $_SESSION['userId']."'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>console.log('Table: ". $_SESSION['userTable']. "');</script>" ;
        echo "<script>console.log('pass: ". $password. "');</script>" ; 
        echo "<script>console.log('id: ". $_SESSION['userId']. "');</script>" ;
        header("Location: index.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }



?>