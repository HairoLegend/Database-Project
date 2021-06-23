<?php
session_start();
?>
<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="../styles.css">
<script src="../js/script.js"></script>
<html lang="en">

<header>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Project Database</title>

    <div class="container">
        <h1 class="logo">Admin Module</h1>

        <nav>
            <ul>
                <li><a href="adminRA.php">Register Admin</a></li>
                <li><a href="adminRL.php">Register Lecturer</a></li>
                <li><a href="adminRS.php">Register Student</a></li>
                <li><a href="adminRSub.php">Register Subject</a></li>
                <li><a href="adminRW.php">Register Workload</a></li>
                <li><a href="../logout.php">Log Out</a></li>
            </ul>
        </nav>

    </div>

</header>

<body>
    <h3 style="margin-left: 120px; margin-top: 20px;">Register Admin</h3>
    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th>Admin ID</th>
                <th>Admin Name</th>
                <th style="text-align: center;">Update / Delete / Add</th>
            </tr>

            <?php
            include "../database.php";

            $sql = "SELECT id, name FROM admin";
            $result = $conn->query($sql);
            $num = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    ++$num;
            ?>

                    <tr>
                        <td id="id<?= $num ?>"><?php echo $row["id"] ?></td>
                        <td contentEditable=" false" id="name<?= $num ?>"><?php echo $row["name"] ?></td>
                        <td style="text-align: center;">
                            <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)">Edit</button>
                            <button id="save<?= $num ?>" onclick="update('admin',<?= $num ?>)" style="margin: 5px;" hidden>Update</button>
                            <button id="delete<?= $num ?>" onclick="remove('admin',<?= $num ?>)">Delete</button>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            <tr>
                <form method="POST">
                    <td><input type="text" name="id" placeholder="Enter new admin ID" style="width: auto;"></td>
                    <td><input type="text" name="name" placeholder="Enter new admin name" style="width: auto;"></td>
                    <td style="text-align: center;">
                        <button name="add" type="submit" style="width: auto;">Add</button>
                    </td>
                </form>
            </tr>
            <?php

            include "../database.php";

            if (isset($_POST['add'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $sql = "INSERT INTO admin (id, name, password) VALUES ('$id', '$name', '$id')";

                if ($conn->query($sql) === true) {
                    // Success
                    echo "Success";
                } else {
                    // Failed
                    echo "Error: " . $sql . " | " . $conn->error;
                    die();
                }
                echo "<meta http-equiv='refresh' content='0'>";
            }

            $conn->close();
            ?>
        </table>
    </div>

</body>

</html>