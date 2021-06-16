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
        <h3>Quiz Objective</h3>
        <h6>Subject Name : </h6>
        <h6>Subject Code : </h6>
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
                <th>Your Answer</th>
                <th>Confirm Answer</th>
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Why are you gay?</td>
                <td>No U</td>
                <td>Your mom gay</td>
            </tr>


            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Kenapa lelaki dan insan yang bernama Norman Hakim terlalu hensem?</td>
                <td>Fitrah</td>
                <td>Built different</td>
                <td>Norman itu Wali</td>
                <td>Ngamsoi</td>
                <td><select name="Answer">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                </td>
                </td>
                <td style="text-align: center;">
                    <input type="submit" value="Confirm">
                </td>
            </tr>

        </table>
        <br>

        <div style="text-align: right;">
            <input id="button" type="submit" value="Finish Quiz">
        </div>

    </div>

</body>

</html>