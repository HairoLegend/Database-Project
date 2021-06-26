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
        <h3>Create True / False Quiz </h3>
        <h6>Subject Name : <?= $name ?></h6>
        <h6>Subject Code : <?= $code ?></h6>
    </div>
    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">No</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Modified By</th>
                <th>Modified On</th>
                <th>Update / Delete / Add</th>
            </tr>
            <?php

            //Displaying data in table
            include('../database.php');

            $sql = "SELECT id, question, answer, Modified_by, Date_modified FROM quiztf WHERE subject_id = '$code'";
            $result = $conn->querY($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ++$num;

            ?>
                    <tr>
                        <td id="id<?= $num ?>"><?php echo $num ?></td>
                        <td id="question<?= $num ?>"><?php echo $row["question"] ?></td>
                        <td style="text-align: center;"><select name="answer" disabled>
                                <option value="True" <?php echo ($row['answer'] == 'True') ? 'selected' :  ''; ?>>True</option>
                                <option value="False" <?php echo ($row['answer'] == 'False') ? 'selected' :  ''; ?>>False</option>
                        </td>
                        <td style="text-align: center;"><?= $row['Modified_by'] ?></td>
                        <td style="text-align: center;"><?= $row['Date_modified'] ?></td>
                        <td style="text-align: center;">
                            <button id="delete<?= $num ?>" onclick="remove_question('quiztf',<?= $num . ',' . $row['id'] ?>)">Delete</button>
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
                    <td></td>
                    <td><input type="text" name="question" placeholder="Enter question" style="width: auto;"></td>
                    <td style="text-align: center;"><select name="answer">
                            <option value="True">True</option>
                            <option value="False">False</option>
                    </td>
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

                $question = $_POST['question'];
                $answer = $_POST['answer'];
                $modiOn = date("Y-m-d h:i:s");

                $sql = "INSERT INTO quiztf (subject_id, question, answer, Modified_by, Date_modified) VALUES ('$code', '$question', '$answer', '$user','$modiOn')";

                if ($conn->query($sql) === true) {
                    // Success
                    $_SESSION['msg'] = "Question added successfully!";
                    $_SESSION['status'] = "Success";
                } else {
                    // Failed
                    $_SESSION['msg'] = "Error: " . $sql . " | " . $conn->error;
                    $_SESSION['status'] = "Fail";
                }
                echo "<meta http-equiv='refresh' content='0'>";
            }


            $conn->close();
            ?>
        </table>
    </div>

</body>

</html>

<script>
    function remove_question(table, n, id) {
        var question = document.getElementById("question" + n).innerText;
        var url = ("deleteQ.php?table=" + table + "&id=" + id);
        var msg = "Are you sure want to delete this question?\n\n ID :\n" + id + "\n\n Question :\n" + question;
        var conf = confirm(msg);
        if (conf)
            window.location = "" + url;
    }
</script>