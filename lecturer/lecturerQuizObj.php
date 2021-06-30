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
        <h3>Create Quiz Objective </h3>
        <h6>Subject Name : <?= $name ?></h6>
        <h6>Subject Code : <?= $code ?> </h6>
    </div>
    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">No</th>
                <th>Question</th>
                <th>Answer A</th>
                <th>Answer B</th>
                <th>Answer C</th>
                <th>Answer D</th>
                <th>Correct Answer</th>
                <th>Modified By</th>
                <th>Modified On</th>
                <th>Update / Delete / Add</th>
            </tr>

            <?php
            //Displaying data in table
            include('../database.php');

            $sql = "SELECT * FROM quizobj WHERE subject_id = '$code'";
            $result = $conn->querY($sql);
            $num = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ++$num;

            ?>
                    <tr style="text-align: center;">
                        <td id="id<?= $num ?>"><?php echo $num ?></td>
                        <td id="question<?= $num ?>"><?php echo $row["question"] ?></td>
                        <td id="answerA<?= $num ?>"><?php echo $row["option_a"] ?></td>
                        <td id="answerB<?= $num ?>"><?php echo $row["option_b"] ?></td>
                        <td id="answerC<?= $num ?>"><?php echo $row["option_c"] ?></td>
                        <td id="answerD<?= $num ?>"><?php echo $row["option_d"] ?></td>
                        <td><select name="answer" disabled>
                                <option value="A" <?php echo ($row['answer'] == 'A') ? 'selected' :  ''; ?>>A</option>
                                <option value="B" <?php echo ($row['answer'] == 'B') ? 'selected' :  ''; ?>>B</option>
                                <option value="C" <?php echo ($row['answer'] == 'C') ? 'selected' :  ''; ?>>C</option>
                                <option value="D" <?php echo ($row['answer'] == 'D') ? 'selected' :  ''; ?>>D</option>
                        </td>
                        <td><?= $row['Modified_by'] ?></td>
                        <td><?= $row['Date_modified'] ?></td>
                        <td style="text-align: center;">
                            <button id="update<?= $num ?>" data-toggle="modal" data-target="#staticBackdrop<?= $num ?>">Edit</button>
                            <button type="submit" name="update" hidden>Update</button>
                            <button id="delete<?= $num ?>" onclick="remove_question('quizobj',<?= $num . ',' . $row['id'] ?>)">Delete</button>
                        </td>
                    </tr>
            <?php

                }
            } else {
                echo "0 results";
            }
            $conn->close();

            ?>

            <tr style="text-align: center;">
                <form method="POST">
                    <td></td>
                    <td><input type="text" name="question" placeholder="Enter question"></td>
                    <td><input type="text" name="option_a" placeholder="Enter answer A"></td>
                    <td><input type="text" name="option_b" placeholder="Enter answer B"></td>
                    <td><input type="text" name="option_c" placeholder="Enter answer C"></td>
                    <td><input type="text" name="option_d" placeholder="Enter answer D"></td>
                    <td><select name="answer">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
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
                $option_a =  $_POST['option_a'];
                $option_b =  $_POST['option_b'];
                $option_c =  $_POST['option_c'];
                $option_d =  $_POST['option_d'];
                $answer = $_POST['answer'];
                $modiOn = date("Y-m-d h:i:s");

                $sql = "INSERT INTO quizobj (subject_id, question, option_a, option_b, option_c, option_d, answer, Modified_by, Date_modified) 
                    VALUES ('$code', '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$answer', '$user','$modiOn')";

                if ($conn->query($sql) === true) {
                    // Success
                    echo "Success";
                } else {
                    // Failed
                    echo  "Error: " . $sql . " | " . $conn->error;
                }
                echo "<meta http-equiv='refresh' content='0'>";
            }

            if (isset($_POST['update'])) {

                $id = $_POST['id'];
                $question = $_POST['question'];
                $option_a =  $_POST['option_a'];
                $option_b =  $_POST['option_b'];
                $option_c =  $_POST['option_c'];
                $option_d =  $_POST['option_d'];
                $answer = $_POST['answer'];
                $modiOn = date("Y-m-d h:i:s");
    
                $sql = "UPDATE quizobj 
                        SET question = '$question', 
                            answer = '$answer', 
                            option_a = '$option_a', 
                            option_b = '$option_b', 
                            option_c = '$option_c', 
                            option_d = '$option_d', 
                            Modified_by = '$user', 
                            Date_modified = '$modiOn' 
                        WHERE id = '$id'";
    
                if ($conn->query($sql) === true) {
                    // Success
                    $_SESSION['msg'] = "Question updated successfully!";
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
    <div style="margin: 100px;">
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