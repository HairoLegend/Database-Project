<?php
session_start();
// User type verification
if ($_SESSION['userTable'] != 'student')
    header("Location: /index.php");

$userID = $_SESSION['userId'];
$UserName = $_SESSION['userName'];

?>

<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="../styles.css">
<html lang="en">

<header>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Project Database</title>

    <div class="container">
        <h1 class="logo">Student Module</h1>

        <nav>
            <ul>
                <li><a href="studentHome.php">Home</a></li>
                <li><a href="studentRegSub.php">Register Subject</a></li>
                <li><a href="../logout.php">Log Out</a></li>
            </ul>
        </nav>

    </div>

</header>

<body>
    <div style="margin-left: 120px; margin-top: 20px;">
        <h3>Main Dashboard</h3>
        <h6>Student Name : <?= $UserName; ?> </h6>
        <h6>Student ID : <?= $userID; ?></h6>
    </div>

    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th>Lecturer</th>
                <th>Subject</th>
                <th>Task</th>
                <th>True / False Mark</th>
                <th>True / False Quiz</th>
                <th>Objective Quiz Mark</th>
                <th>Objective Quiz</th>

            </tr>
            <?php
            include '../database.php';

            $sql = "SELECT l.name AS lecturer_name, l.id AS lecturer_id, s.name AS subject_name, 
                ss.subject_id AS subject_id, ss.tf_result AS tf_mark, ss.obj_result AS obj_mark
                FROM studentmark ss
                JOIN lecturer l ON ss.lecturer_id = l.id
                JOIN subject s ON ss.subject_id = s.id
                WHERE ss.student_id = '$userID';";

            $result = $conn->query($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ++$num;

            ?>
                    <tr style="text-align: center;">
                        <td><?= $row['lecturer_name'] ?></td>
                        <td><?= $row['subject_name'] ?></td>
                        <td style="text-align: center;">
                            <button title="View Task" onclick="location.href = 'studentTask.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>&lid=<?= $row['lecturer_id'] ?>';">View</button>
                        </td>
                        <td><?= $row['tf_mark'] ?></td>
                        <td>
                            <button title="View Quiz TF" onclick="location.href = 'studentTF.php';">View</button>
                        </td>
                        <td><?= $row['obj_mark'] ?></td>
                        <td>
                            <button title="View Quiz Objective" onclick="location.href = 'studentObj.php';">View</button>
                        </td>

                    </tr>
            <?php
                }
            } else {
                echo "No results found";
            }

            $conn->close();
            ?>
        </table>
    </div>

</body>

</html>