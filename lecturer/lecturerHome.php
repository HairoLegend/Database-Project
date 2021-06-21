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
        <h1 class="logo">Lecturer Module</h1>

        <nav>
            <ul>
                <li><a href="lecturerHome.php">Home</a></li>
                <li><a href="../index.php">Log Out</a></li>
            </ul>
        </nav>

    </div>

</header>

<body>
    <div style="margin-left: 120px; margin-top: 20px;">
        <h3>Main Dashboard</h3>
        <h6>Lecturer Name : </h6>
        <h6>Lecturer ID : </h6>
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

            <tr>
                <td>Database</td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerTask.php';" type="button" value="Create">
                </td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerResultTF.php';" type="submit" value="Result">
                    <input onclick="location.href = 'lecturerQuizTF.php';" type="submit" value="Create / View Quiz">
                </td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerResultObj.php';" type="submit" value="Result">
                    <input onclick="location.href = 'lecturerQuizObj.php';" type="submit" value="Create / View Quiz"></td>
            </tr>

            <tr>
                <td>Creativity and Innovation</td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerTask.php';" type="button" value="Create">
                </td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerResultTF.php';" type="submit" value="Result">
                    <input onclick="location.href = 'lecturerQuizTF.php';" type="submit" value="Create / View Quiz">
                </td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'lecturerResultObj.php';" type="submit" value="Result">
                    <input onclick="location.href = 'lecturerQuizObj.php';" type="submit" value="Create / View Quiz"></td>
            </tr>

        </table>
    </div>

</body>

</html>