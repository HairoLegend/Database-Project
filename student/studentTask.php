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
        <h3>Task Module</h3>
        <h6>Subject Name :</h6>
        <h6>Subject Code :</h6>
    </div>

    <hr>
    <div class="container">
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">No</th>
                <th>Assignment / Lab / Tutorial</th>
                <th>Your File</th>
                <th>Download Task</th>
                <th>Submission</th>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Lab 1</td>
                <td>NormanSongkok.pdf</td>
                <td id="button">
                    <input type="submit" value="Download">
                </td>
                <td>
                    <input type="submit" value="Submission">
                </td>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Lab 1</td>
                <td>NormanSongkok.pdf</td>
                <td id="button">
                    <input type="submit" value="Download">
                </td>
                <td>
                    <input type="submit" value="Submission">
                </td>
            </tr>

        </table>
    </div>

</body>

</html>