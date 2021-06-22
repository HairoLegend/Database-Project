<?php
session_start();
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
        <h6>Subject Name :</h6>
        <h6>Subject Code :</h6>
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
                <th>Update / Delete / Add</th>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Why are you gay?</td>
                <td>No U</td>
                <td>Your mom gay</td>
                <td>Your mom green</td>
                <td>Blyat</td>
                <td><select name="Answer">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
            </td></td>
                <td style="text-align: center;">
                    <input style="margin: 5px;" type="submit" value="Update">
                    <input type="submit" value="Delete">
                </td>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">2</td>
                <td><input type="text" name="Question" placeholder="Enter question" style="width: auto;"></td>
                <td><input type="text" name="Answer" placeholder="Enter answer A" style="width: auto;"></td>
                <td><input type="text" name="Answer" placeholder="Enter answer B" style="width: auto;"></td>
                <td><input type="text" name="Answer" placeholder="Enter answer C" style="width: auto;"></td>
                <td><input type="text" name="Answer" placeholder="Enter answer D" style="width: auto;"></td>
                <td><select name="Answer">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
            </td></td>
                <td style="text-align: center;">
                    <input type="submit" value="Add">
                </td>
            </tr>

        </table>
    </div>

</body>

</html>