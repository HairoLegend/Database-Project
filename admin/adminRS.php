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
                <li><a href="../index.php">Log Out</a></li>
            </ul>
        </nav>

    </div>
</header>

<body>
    <h3 style="margin-left: 120px; margin-top: 20px;">Register Student</h3>
    <hr>
    <div class="container">
        <table id="tablestyle">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Modified By</th>
                <th>Modified On</th>
                <th style="text-align: center;">Update / Delete</th>
            </tr>

            <?php
            include "../database.php";

            $sql = "SELECT id, name, email, Modified_by, Date_modified FROM student";
            $result = $conn->query($sql);
            $num = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    ++$num;
            ?>

                    <tr>
                        <td id="id<?= $num ?>"><?php echo $row["id"] ?></td>
                        <td id="name<?= $num ?>"><?php echo $row["name"] ?></td>
                        <td id="modi"><?= $row['email']; ?></td>
                        <td><?php echo $row["Modified_by"] ?></td>
                        <td><?php echo $row["Date_modified"] ?></td>
                        <td style="text-align: center;">
                            <button id="update<?= $num ?>" onclick="edit(<?= $num ?>)">Edit</button>
                            <button id="save<?= $num ?>" onclick="update('student',<?= $num ?>)" style="margin: 5px;" hidden>Update</button>
                            <button id="delete<?= $num ?>" onclick="remove('student',<?= $num ?>)">Delete</button>
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
                    <td><input type="text" name="id" placeholder="Enter new student ID" style="width: auto;"></td>
                    <td><input type="text" name="name" placeholder="Enter new student name" style="width: auto;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: center;">
                        <button name="add" type="submit" style="width: auto;">Add</button>
                    </td>
                </form>
            </tr>
            <?php

            include "../database.php";
            date_default_timezone_set("Asia/Kuala_Lumpur");
            
            if (isset($_POST['add'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $id . "@siswa.uthm.edu.my";
                $Modified_by = "Super admin";
                $Date_modified = date("Y-m-d H:i:s");
                $sql = "INSERT INTO student (id, name, email, password, Modified_by, Date_modified) VALUES('$id', '$name', '$email', '$id', '$Modified_by', '$Date_modified')";
                
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
