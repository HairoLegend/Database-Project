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
                <li><a href="lecturerHome.html">Home</a></li>
                <li><a href="../index.html">Log Out</a></li>
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
        <label for="id">Assignment / Lab / Tutorial :</label>
        <input type="text" placeholder="Enter task name" style="margin: left 30px; width: 300x;">
        <input type="submit" value="Choose File" style="width: auto;">
        <input type="submit" value="Upload" style="width: auto;">

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
                    <input onclick="location.href = 'lecturerTaskSub.html';" type="submit" value="Submission">
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
                    <input onclick="location.href = 'lecturerTaskSub.html';" type="submit" value="Submission">
                </td>
                <td id="button">
                    <input type="submit" value="Delete">
                </td>
            </tr>
        </table>
    </div>

</body>



</html>