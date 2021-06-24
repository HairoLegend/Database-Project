<?php
session_start();
?>
<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="../styles.css">
<script src="../js/script.js"></script>
<html lang="en">

<?php
// User type verification
if ($_SESSION['userTable'] != 'lecturer')
    header("Location: /index.php");

$userID = $_SESSION['userId'];
$UserName = $_SESSION['userName'];
?>

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
        <h3>Main Dashboard</h3>
        <h6>Lecturer Name : <?= $UserName; ?> </h6>
        <h6>Lecturer ID : <?= $userID; ?></h6>
    </div>

    <hr>

    <div class="container">
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">Subject</th>
                <th>Create Task</th>
                <th>Quiz True / False</th>
                <th>Quiz Objective</th>

            </tr>
            <?php
            include "../database.php";

            $sql = "SELECT s.name AS subject_name, s.id AS subject_id FROM SUBJECT S JOIN workload wl ON s.id = wl.subject_id JOIN lecturer l ON wl.lecturer_id = l.id WHERE l.id = '$userID';";
            $result = $conn->query($sql);
            $num = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    ++$num;
            ?>
                    <tr>
                        <td id="subject_name<?= $num ?>"><?php echo $row["subject_name"] ?></td>
                        <td style="text-align: center;">
                            <button title="Add New Assignment & Tutorial" onclick="location.href = 'lecturerTask.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';">Create</button>
                        </td>
                        <td style="text-align: center;">
                            <button title="View True False Result" onclick="location.href = 'lecturerResultTF.php';">Result</button>
                            <button title="Add New True False Quiz" onclick="location.href = 'lecturerQuizTF.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';">Create/View</button>
                        </td>
                        <td style="text-align: center;">
                            <button title="View Objective Result" onclick="location.href = 'lecturerResultObj.php';">Result</button>
                            <button title="Add New Objective Quiz" onclick="location.href = 'lecturerQuizObj.php?code=<?= $row['subject_id'] ?>&name=<?= $row['subject_name'] ?>';">Create/View</button>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </table>
    </div>


</body>

</html>