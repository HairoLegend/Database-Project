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
    <h3 style="margin-left: 120px; margin-top: 20px;">Register Workload</h3>
    <hr>
    <div class="container">

        <table id="tablestyle">
            <tr>
                <th>Lecturer ID / Name</th>
                <th>Subject ID / Name</th>
                <th style="text-align: center;">Delete / Add</th>
            </tr>
            <?php
            include "../database.php";

            $sql = "SELECT  l.id as lecturer_id, l.name AS lecturer_name, s.id AS subject_id, s.name AS subject_name 
                            FROM subject s
                            JOIN workload wl ON s.id = wl.subject_id
                            JOIN lecturer l ON wl.lecturer_id = l.id;";

            $result = $conn->query($sql);
            $num = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    ++$num;
                    // $lecturer_name = $row['lecturer_id'];

            ?>

                    <tr>
                        <form method="post">
                            <td><?= $row['lecturer_id'] ?> : <?= $row['lecturer_name'] ?>
                                <input type="hidden" name="lecturerId" value="<?= $row['lecturer_id'] ?>">
                            </td>
                            <td><?= $row['subject_id'] ?> : <?= $row['subject_name'] ?>
                                <input type="hidden" name="subjectId" value="<?= $row['subject_id'] ?>">
                            </td>
                            <td style="text-align: center;">
                                <button name="delete" id="delete<?= $num ?>" onclick="remove('subject',<?= $num ?>)">Delete</button>
                            </td>

                        </form>
                    </tr>
            <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>

            <tr>
                <form method="post">

                    <td>
                        <select name="lecturer_id" class="custom-select">
                            <option selected>Please Choose</option>

                            <?php
                            include "../database.php";

                            $sql = "SELECT id, name FROM lecturer";
                            $result = $conn->query($sql);
                            $num = 0;
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ++$num;
                            ?>
                                    <option style="text-transform: uppercase;" value="<?= $row['id'] ?>"><?= $row['id'] ?> : <?= $row['name'] ?></option>
                            <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>

                        </select>
                    </td>
                    <td>
                        <select name="subject_id" class="custom-select">
                            <option style="text-transform: uppercase;" selected>Please Choose</option>

                            <?php
                            include "../database.php";

                            $sql = "SELECT id, name FROM subject";
                            $result = $conn->query($sql);
                            $num = 0;
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ++$num;
                            ?>
                                    <option style="text-transform: uppercase;" value="<?= $row['id']  ?>"><?= $row['id']  ?> : <?= $row['name'] ?></option>
                            <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>

                        </select>
                    </td>
                    <td style="text-align: center;">
                        <button name="add" type="submit" style="width: auto;">Add</button>
                    </td>
                </form>
            </tr>

            <?php

            include "../database.php";
            if (isset($_POST['add'])) {

                $lecturer = $_POST['lecturer_id'];
                $subject = $_POST['subject_id'];
                $sql = "INSERT INTO workload (lecturer_id, subject_id) VALUES ('$lecturer', '$subject')";

                if ($conn->query($sql) === true) {
                    // Success
                    echo "Success";
                } else {
                    // Failed
                    echo "Error: Already assigned " . $conn->error;
                    die();
                }
                echo "<meta http-equiv='refresh' content='0'>";
            }

            if (isset($_POST['delete'])) {

                $lecturer = $_POST['lecturerId'];
                $subject =  $_POST['subjectId'];

                $sql = "DELETE FROM workload WHERE lecturer_id = '$lecturer' AND subject_id= '$subject'";

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