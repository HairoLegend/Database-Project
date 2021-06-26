<?php
session_start();
$code = $_GET['code'];
$name = $_GET['name'];
$title = $_GET['title'];
$id = $_GET['id'];
$userID = $_SESSION['userId'];
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
        <h1 class="logo">Lecturer Module</h1>

        <nav>
            <ul>
                <li><a href="lecturerHome.php">Home</a></li>
                <li><a href="../logout.php">Log Out</a></li>
            </ul>
        </nav>

    </div>

</header>

<body>
    <div style="margin-left: 120px; margin-top: 20px;">
        <h3>Task Submission</h3>
        <h6>Subject Name : <?= $name  ?></h6>
        <h6>Subject Code : <?= $code ?></h6>
    </div>
    <hr>

    <div class="container">
        <label for="id">Task Name : <?= $title ?></label>
        <table id="tablestyle">

            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>File Name</th>
                <th>View Content</th>
            </tr>
            <?php
            include('../database.php');

            //Displaying data
            $sql = "SELECT stud.name AS student_name, stud.id AS student_id, assgn.file AS file, assgn.file_name AS file_name, assgn.file AS file, assgn.type AS type
                            FROM studenttask assgn
                            JOIN student stud ON assgn.student_id = stud.id
                            WHERE lecturer_id = '$userID' AND assgn.task_id = '$id'";
            $result = $conn->query($sql);
            $num = 0;

            // $targetFilePath = $targetDir . $fileName;
            // $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // $targetFilePath = '../../student_assignment/' . $row['file_name'];
                    // $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    //$ext = end(explode('.', $row['file_name']));
                    $ext = substr(strrchr($row['file_name'], '.'), 1);
                    ++$num;
            ?>
                    <tr style="text-align: center;">
                    <td><?= $row['student_name'] ?></td>
                    <td style="text-align: center;"><?= $row['student_id'] ?></td>
                    <td style="text-align: center;"><?= $row['file_name'] ?></td>
                        <td style="text-align: center;">
                        <button id="view" title="View Content" onclick="window.open('../student/task_file/<?= $row['file_name']?>')" >Download</button>
                    </tr>
            <?php
                }
            } else
                echo "0 result"
            ?>
        </table>
    </div>

</body>



</html>