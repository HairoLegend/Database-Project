<?php
session_start();

$userID = $_SESSION['userId'];
$UserName = $_SESSION['userName'];
$code = $_GET['code'];
$name = $_GET['name'];

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
        <h3>Quiz Objective</h3>
        <h6>Subject Name : <?= $name; ?> </h6>
        <h6>Subject Code : <?= $code; ?></h6>
    </div>

    <hr>
    <div class="container">
        <form action="CalculateMark.php" method="POST">
            <table id="tablestyle">

                <tr>
                    <th style="text-align: left;">No</th>
                    <th>Question</th>
                    <th>Answer A</th>
                    <th>Answer B</th>
                    <th>Answer C</th>
                    <th>Answer D</th>
                    <th>Your Answer</th>
                </tr>
                <?php

                //Displaying data in table
                include('../database.php');

                $sql = "SELECT question, option_a, option_b, option_c, option_d FROM quizobj WHERE subject_id = '$code'";
                $result = $conn->query($sql);
                $num = 0;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $num++;

                ?>

                        <tr style="text-align: center;">
                            <td id="id<?= $num ?>"><?php echo $num ?></td>
                            <td id="question<?= $num ?>"><?php echo $row["question"] ?></td>
                            <td id="answerA<?= $num ?>"><?php echo $row["option_a"] ?></td>
                            <td id="answerB<?= $num ?>"><?php echo $row["option_b"] ?></td>
                            <td id="answerC<?= $num ?>"><?php echo $row["option_c"] ?></td>
                            <td id="answerD<?= $num ?>"><?php echo $row["option_d"] ?></td>
                            <td><select name="answer_q<?= $num ?>">
                                    <option id="option_a<?= $num ?>" value="A" name="answer_q<?= $num ?>">A</option>
                                    <option id="option_b<?= $num ?>" value="B" name="answer_q<?= $num ?>">B</option>
                                    <option id="option_c<?= $num ?>" value="C" name="answer_q<?= $num ?>">C</option>
                                    <option id="option_d<?= $num ?>" value="D" name="answer_q<?= $num ?>">D</option>
                            </td>
                    <?php

                    }
                } else {
                    echo "<br>";
                    $_SESSION['msg'] = "Quiz is not available yet.";
                    $_SESSION['status'] = "Fail";
                    die();
                }

                // To redirect user if he/she already answered
                $marks = $conn->query("SELECT obj_result FROM studentmark WHERE (subject_id = '$code' && student_id = '$userID')")->fetch_object()->obj_result;
                if ($marks > 0) {
                    echo '<script> alert("Oi, you already answer la, go back."); window.location = "studentHome.php";</script>';
                }

                $conn->close();

                    ?>

                        </tr>

                        <input type="hidden" name="quiz" value="quizobj">
                        <input type="hidden" name="marks" value="obj_result">
                        <input type="hidden" name="subject_code" value="<?= $code ?>">
                        <input type="hidden" name="student_id" value="<?= $userID ?>">
                        <input type="hidden" name="total_questions" value="<?= $num ?>">

            </table>
            <div style="text-align: right;">
                <input id="button" type="submit" value="Finish Quiz">
            </div>
        </form>


        <br>

    </div>

</body>

</html>