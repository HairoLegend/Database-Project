<?php
session_start();

$_SESSION['status'] = null;
$_SESSION['msg'] = null;
$_SESSION['loginErr']= "ok";

if ($_SESSION['loginErr']==null){
    echo '<script language="javascript">';
    echo 'alert("Error Login Credential")';
    echo '</script>';
    $_SESSION['loginErr']="ok";
}

?>

<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">
<html lang="en">

<head>
    <header>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Tab Title-->
        <title>Project Database</title>

        <div class="container logo">
            <h1>Welcome to Project Database System</h1>
            <small>Founded by Hazim, Norman and Danish  </small>
        </div>
    </header>
</head>

<body>
    <div class="container">

        <div class="col-3" style="margin:auto">
            <!-- image for fun -->
            <div class="text-center">
                <img src="TheGeng.PNG" alt="cubateka.PNG" style="width: 300px; height: 200px; margin-top: 30px;">
            </div>
            <!--Style to create box-->
            <div style="border: 2px solid black; padding: 15px;">
                <form action="login.php" method="POST" style="padding-top: 15px ;">
                    <!--path file jangan lupa-->

                    <!-- ID and Password -->
                    <label for="id">ID :</label>
                    <input type="text" id="user" name="user" placeholder="Enter your ID" style="margin-left:50px;" required>

                    <br><br>

                    <label for="password">Password :</label>
                    <input type="password" id="pass" name="pass" placeholder="Enter your password" required><br>

                    <!--Radio Box for Admin, Lecturer and Student -->
                    <input type="radio" id="admin" name="usertype" value="admin" required>
                    <label for="admin">Admin</label><br>

                    <input type="radio" id="lecturer" name="usertype" value="lecturer" required>
                    <label for="lecturer">Lecturer</label><br>

                    <input type="radio" id="student" name="usertype" value="student" required>
                    <label for="student">Student</label><br>

                    <!--Button-->
                    <input type="submit" value="Submit" class="btn btn-default btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>


