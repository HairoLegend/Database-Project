<?php
session_start();
$code = $_GET['code'];
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
            <input type="file" name="task" id="file=upload">

        </form>
        <?php
        include('../database.php');

        //Uploading file to database
        if (isset($_POST['uploadBtn'])) {
            $statusMsg = '';

            // File upload path
            $targetDir = __DIR__ . '\task_files\\';
            $fileName = basename($_FILES['task']['name']);
            $fileName = addslashes($fileName); // To ensure names with special characters are accepted
            $targetFilePath = $targetDir . $fileName;
            $filetmp = $_FILES['task']['tmp_name'];
            $fileSize = $_FILES['task']['size'];

            // Opening file for read
            $fp = fopen($filetmp, 'r');
            $content = fread($fp, filesize($filetmp));
            $content = addslashes($content);
            fclose($fp);
            // Getting file type
            $fileType = substr(strrchr($fileName, '.'), 1);
            $fileType = strtolower($fileType);

            // Title from task title
            $title = $_POST['title'];

            //Checking if button is pressed and file exists
            if (isset($_POST['uploadBtn']) && !empty($_FILES['task']['name'])) {
                // List of all allowed file type
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'txt');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['task']['tmp_name'], $targetFilePath)) {
                        $sql = "INSERT INTO task (subject_id, title, file_name, file, size, type, Modified_by, Date_modified) 
                                VALUES ('$code', '$title', '$fileName', '$content', '$fileSize', '$fileType', '$user', NOW())";
                        $insert = $conn->query($sql);

                        if ($insert) {
                            $_SESSION['msg'] = "The file " . $fileName . " has been uploaded succesfully.";
                            $_SESSION['status']  = "Success";
                            header("Location:lecturerTask.php?code=" . $code . "&name=" . $name);
                            die();
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
            <?php
            //Displaying data in table
            include('../database.php');

            $sql = "SELECT id, title, file_name, Modified_by, Date_modified, file FROM task WHERE subject_id = '$code';";
            $result = $conn->querY($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ++$num;
            ?>
                    <tr style="text-align: center;">
                        <td style="text-align: left;"><?= $num ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['file_name'] ?></td>
                        <td><?= $row['Modified_by'] ?></td>
                        <td><?= $row['Date_modified'] ?></td>
                        <td style="text-align: center;">
                            <button title="View Content" onclick="window.open('task_files/<?= $row['file_name'] ?>')">Download</button>
                        </td>
                        <td style="text-align: center;" title="View Submission">
                            <button onclick="location.href = 'lecturerTaskSub.php?code=<?= $code ?>&name=<?= $name ?>&id=<?= $row['id'] ?>';">View</button>
                        </td>
                        <td style="text-align: center;" title="Delete">
                            <button id="delete" name="delete" del_id="<?= $row['id'] ?>">Delete</button>
                        </td>
                    </tr>

            <?php
                }
            } else
                echo "0 Results";

            $conn->close();


            ?>


        </table>
    </div>

</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    //Deleting function
    $(document).on('click', '#delete', function() {
        var msg = "Are you sure want to delete this task?";
        var conf = confirm(msg);
        if (conf) {
            var del_id = $(this).attr('del_id');
            var $ele = $(this).parent().parent();
            $.ajax({
                type: "POST",
                url: "deleteTask.php",
                data: {
                    del_id: del_id
                },
                success: function(data) {
                    $ele.fadeOut().remove();
                }
            });
            location.reload();
        }
    });
</script>