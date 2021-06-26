<?php
session_start();

$code = $_GET['code'];
$name = $_GET['name'];
$userId = $_SESSION['userId'];

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
        <h3>Quiz Objective Result</h3>
        <h6>Subject Name : <?= $name ?></h6>
        <h6>Subject Code : <?= $code ?></h6>
    </div>
    <hr>

    <div class="container">
        <table id="tablestyle">

            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Result</th>
            </tr>
            <?php
            //Displaying data in table
            include('../database.php');

            $sql = "SELECT stud.name AS student_name, stud.id AS student_id, sub.obj_result AS obj_result
                            FROM studentmark sub
                            JOIN student stud ON sub.student_id = stud.id
                            WHERE sub.subject_id = '$code'";

            $result = $conn->querY($sql);
            $num = 0;
            $count_pass = 0; //Count number of pass 
            $count_fail = 0; //Count number of fails

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ++$num;
            ?>
                    <tr style="text-align: center;">
                        <td><?php echo $row["student_id"] ?></td>
                        <td><?php echo $row["student_name"] ?></td>
                        <td><?php echo $row["obj_result"] ?></td>
                    </tr>
            <?php

                    if ($row['obj_result'] > 0)
                        $count_pass++;
                    else
                        $count_fail++;
                }
            } else {
                echo "0 results";
            }
            $conn->close();

            ?>

        </table>
    </div>
    <div style="margin-left: 120px; margin-top: 20px;">
        <h6>Number of Student Pass : <?= $count_pass ?></h6>
        <h6>Number of Student Fail : <?= $count_fail ?></h6>
    </div>
</body>



</html>