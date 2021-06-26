<?php
session_start();
$userID = $_SESSION['userId'];
$UserName = $_SESSION['userName'];
$lecturerId = $_GET['lid'];
$code = $_GET['code'];
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
        <h3>Task Module</h3>
        <h6>Subject Name : <?= $UserName; ?> </h6>
        <h6>Subject Code : <?= $userID; ?></h6>
    </div>

    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th>Assignment / Lab / Tutorial</th>
                <th>Your File</th>
                <th>Download Task</th>
                <th>Submission</th>
            </tr>
            <?php
            include "../database.php";

            //Retrieving all available task from task table
            $sql2 = "INSERT INTO studenttask (task_id, student_id, lecturer_id, file_name, file, type) 
                            (SELECT id, '$userID', '$lecturerId', '', '', '' FROM task WHERE subject_id = '$code') 
                            ON DUPLICATE KEY UPDATE task_id = task_id";

            $conn->query($sql2);

            //Retrieving assignments for display

            $sql = "SELECT assgnStud.task_id AS task_id, assgn.title AS title, assgn.file_name AS lecturerFile, assgn.file_name AS file, assgn.type AS type, assgnStud.file_name AS studentFile 
                            FROM studenttask assgnStud
                            JOIN task assgn ON assgnStud.task_id = assgn.id
                            JOIN student stud ON assgnStud.student_id = stud.id
                            WHERE assgn.subject_id = '$code' AND stud.id = '$userID'";

            $result = $conn->query($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ++$num;
            ?>
                    <tr style="text-align: center;">
                        <form method="POST" enctype="multipart/form-data">
                            <td><?= $row['title'] ?></td>
                            <td><input type="file" name="task" id="file_upload">
                            </td>
                            <td id="button">
                                <button title="Download Task" onclick="window.open('../lecturer/task_files/<?= $row['file'] ?>')">Download</button><?php echo $row["lecturerFile"] ?>
                            </td>
                            <td> <input type="hidden" name="task_id" value="<?= $row['task_id'] ?>">
                                <button name="uploadBtn">Upload</button>
                            </td>
                        </form>
                    </tr>
            <?php }
            } else
                echo "0 results";

            $conn->close();
            ?>

            <?php
            include('../database.php');

            //Student upload assignment
            if (isset($_POST['uploadBtn'])) {
                $taskId = $_POST['task_id'];
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/student/task_file/'; //Getting from root direcotry to student task folder
                $fileName = basename($_FILES['task']['name']);
                $targetFilePath = $targetDir . $fileName;
                $filetmp = $_FILES['task']['tmp_name'];
                $fileSize = $_FILES['task']['size'];
                $fileType = strtolower(substr(strrchr($fileName, '.'), 1));

                // Opening file for read
                $fp = fopen($filetmp, 'r');
                $content = fread($fp, filesize($filetmp));
                $content = addslashes($content);
                fclose($fp);

                //Checking if button is pressed and file exits
                if (isset($_POST['uploadBtn']) && !empty($_FILES['task']['name'])) {
                    $allowedTypes = array('pdf', 'doc', 'docx');
                    if (in_array($fileType, $allowedTypes)) {
                        if (move_uploaded_file($_FILES['task']['tmp_name'], $targetFilePath)) {
                            $sql = "UPDATE studenttask
                                            SET file_name = '$fileName', file = '$content', size = '$fileSize', type = '$fileType'
                                            WHERE task_id = '$taskId' AND student_id = '$userID'";

                            $insert = $conn->query($sql);

                            if ($insert) {
                                $_SESSION['msg'] = "The file " . $fileName . " has been uploaded succesfully.";
                                $_SESSION['status']  = "Success";
                            } else {
                                $_SESSION['msg'] = "File failed to upload";
                                $_SESSION['status']  = "Fail";
                            }
                        } else {
                            $_SESSION['msg'] = "There was error upload";
                            $_SESSION['status']  = "Fail";
                            die();
                        }
                    } else {
                        $_SESSION['msg'] = "Sorry only pdf doc docx";
                        $_SESSION['status']  = "Fail";
                    }
                }
                die();

                echo "<meta http-equiv='refresh' content='0'>";
            }

            $conn->close();
            ?>

        </table>
    </div>

</body>

</html>