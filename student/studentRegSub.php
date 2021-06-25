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
        <h3>Register Subject</h3>
        <h6>Student Name : <?= $UserName; ?> </h6>
        <h6>Student ID : <?= $userID; ?> </h6>
    </div>

    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th>Lecturer ID</th>
                <th>Lecturer Name</th>
                <th>Subject Code</th>
                <th>Subject</th>
                <th>Register</th>
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
                    <tr style="text-align: center;">
                        <form method="POST">
                            <td><input type="hidden" name="lecturer_id" value="<?= $row['lecturer_id'] ?>">
                                <?= $row['lecturer_id'] ?></td>
                            <td><?= $row['lecturer_name'] ?></td>
                            <td><input type="hidden" name="subject_id" value="<?= $row['subject_id'] ?>">
                                <?= $row['subject_id'] ?></td>
                            <td><?= $row['subject_name'] ?></td>
                            <td style="text-align: center;">
                                <button name="add" title="Register Subject">Register</button>
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

        </table>
    </div>

    <?php
    //Register Subjects for students
    include "../database.php";
    if (isset($_POST['add'])) {
        $lecturerId = $_POST['lecturer_id'];
        $subjectId = $_POST['subject_id'];
        $studentId = $userID;


        $sql = "INSERT INTO studentmark (subject_id, student_id, lecturer_id) VALUES ('$subjectId', '$studentId', '$lecturerId')";
        //
        if ($conn->query($sql) === true) {
            // Success
            $_SESSION['msg'] = "Subject added successfully!";
            $_SESSION['status'] = "Success";
        } else {
            // Failed
            if ($conn->errno == '1062')
                echo "already registered";
            else
                $_SESSION['msg'] = $sql . "<br>" . $conn->error . "<br>" . $conn->errno;
            $_SESSION['status'] = "Fail";
            die();
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

    $conn->close();

    ?>
</body>

</html>