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
        <h3>Task Submission</h3>
        <h6>Subject Name :</h6>
        <h6>Subject Code :</h6>
    </div>
    <hr>

    <div class="container">
        <label for="id">Task Name : Lab 1</label>
        <table id="tablestyle">

            <tr>
                <th style="text-align: left;">No</th>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>File Name</th>
                <th>View Content</th>

            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">1</td>
                <td>Muhammad Hazim</td>
                <td>AI190065</td>
                <td>HazimHensem.pdf</td>
                <td style="text-align: center;">
                    <input type="submit" value="Download File">
            </tr>

            <tr style="text-align: center;">
                <td style="text-align: left;">2</td>
                <td>Muhammad Hazim</td>
                <td>AI190065</td>
                <td>SongkokNorman.pdf</td>
                <td style="text-align: center;">
                    <input type="submit" value="Download File">
            </tr>
        </table>
    </div>

</body>



</html>