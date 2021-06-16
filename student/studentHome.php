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
                <li><a href="../index.php">Log Out</a></li>
            </ul>
        </nav>

    </div>

</header>

<body>
    <div style="margin-left: 120px; margin-top: 20px;">
        <h3>Main Dashboard</h3>
        <h6>Student Name : Norman Hensem Sting aku yahu</h6>
        <h6>Student ID : </h6>
    </div>

    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">No</th>
                <th>Lecturer</th>
                <th>Subject</th>
                <th>Task</th>
                <th>True / False Mark</th>
                <th>True / False Quiz</th>
                <th>Objective Quiz Mark</th>
                <th>Objective Quiz</th>

            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Muhammad Hazim</td>
                <td>Database</td>
                <td style="text-align: center;">
                    <input onclick="location.href = 'studentTask.php';" type="submit" value="View">
                </td>
                <td></td>
                <td>
                    <input onclick="location.href = 'studentTF.php';" type="submit" value="View">
                </td>
                <td></td>
                <td>
                    <input onclick="location.href = 'studentObj.php';" type="submit" value="View">
                </td>

            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Danish Hensem</td>
                <td>Creativity and Innovation</td>
                <td style="text-align: center;">
                    <input type="submit" value="View">
                </td>
                <td></td>
                <td>
                    <input type="submit" value="View">
                </td>
                <td></td>
                <td>
                    <input type="submit" value="View">
                </td>

            </tr>

        </table>
    </div>

</body>

</html>