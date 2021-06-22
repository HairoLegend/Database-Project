<?php
session_start();
$code = strtoupper($_GET['code']);
$name = $_GET['name'];
$user = $_SESSION['userName'];

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
        <h3>Task Module</h3>
        <h6>Subject Name : <?= $name ?></h6>
        <h6>Subject Code : <?= $code ?></h6>
    </div>
    <hr>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <label for="id">Assignment / Lab / Tutorial :</label>
            <input type="text" name="title" id="file" placeholder="Enter task name" style="margin: left 30px; width: auto;">
            <button name="uploadBtn">Upload</button>
            <input type="file" name="assignment" id="file=upload">

        </form>
        <?php
        include('../../database/DB.php');

        //Uploading file to database
        if (isset($_POST['uploadBtn'])) {
            $statusMsg = '';

            // File upload path
            $targetDir = __DIR__ . '\assignment_files\\';
            $fileName = basename($_FILES['assignment']['name']);
            $fileName = addslashes($fileName); // To ensure names with special characters are accepted
            $targetFilePath = $targetDir . $fileName;
            $filetmp = $_FILES['assignment']['tmp_name'];
            $fileSize = $_FILES['assignment']['size'];

            // Opening file for read
            $fp = fopen($filetmp, 'r');
            $content = fread ($fp, filesize($filetmp));
            $content = addslashes($content);
            fclose($fp);        
            // Getting file type
            $fileType = substr(strrchr($fileName, '.'), 1);
            $fileType = strtolower($fileType);

            // Title from task title
            $title = $_POST['title'];

            //Checking if button is pressed and file exists
            if (isset($_POST['uploadBtn']) && !empty($_FILES['assignment']['name'])) {
                // List of all allowed file type
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'txt');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['assignment']['tmp_name'], $targetFilePath)) {
                        $sql = "INSERT INTO assignment (subject_id, title, file_name, file, size, type, modiBy, modiOn) 
                                VALUES ('$code', '$title', '$fileName', '$content', '$fileSize', '$fileType', '$user', NOW())";

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
                    }
                } else {
                    $_SESSION['msg'] = "Sorry only pdf doc docx";
                    $_SESSION['status']  = "Fail";
                }
            }
        }

        $conn->close();
        //Alert message display
        include('../../templates/alert_msg.php');
        ?>
        
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">No</th>
                <th>Task Name</th>
                <th>File</th>
                <th>Modified By</th>
                <th>Modified On</th>
                <th>View Content</th>
                <th>View Submission</th>
                <th>Delete</th>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Lab 1</td>
                <td>HazimHensem.pdf</td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <input type="submit" value="Download File">
                </td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerTaskSub.php';" type="submit" value="Submission">
                </td>
                <td style="text-align: center;">
                    <input type="submit" value="Delete">
                </td>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">2</td>
                <td>Tutorial 1</td>
                <td>SongkokNorman.pdf</td>
                <td></td>
                <td></td>
                <td id="button">
                    <input type="submit" value="Download File">
                </td>
                <td id="button">
                    <input onclick="location.href = 'lecturerTaskSub.php';" type="submit" value="Submission">
                </td>
                <td id="button">
                    <input type="submit" value="Delete">
                </td>
            </tr>
        </table>
    </div>

</body>



</html>