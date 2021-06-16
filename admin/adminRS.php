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
        <h1 class="logo">Admin Module</h1>

        <nav>
            <ul>
                <li><a href="adminRA.php">Register Admin</a></li>
                <li><a href="adminRL.php">Register Lecturer</a></li>
                <li><a href="adminRS.php">Register Student</a></li>
                <li><a href="adminRSub.php">Register Subject</a></li>
                <li><a href="adminRW.php">Register Workload</a></li>
                <li><a href="../index.php">Log Out</a></li>
            </ul>
        </nav>

    </div>
</header>

<body>
    <h3 style="margin-left: 120px; margin-top: 20px;">Register Student</h3>
    <hr>
    <div class="container">
        <table id="tablestyle">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Modified By</th>
                <th>Modified On</th>
                <th style="text-align: center;">Update / Delete</th>
            </tr>

            <tr>
                <td>AI190065</td>
                <td>Muhammad Hazim bin Mohd Alim</td>
                <td>hazimm2000@gmail.com</td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <input style="margin: 5px;" type="submit" value="Update"><input type="submit" value="Delete">
                </td>
            </tr>
            <tr>
                <td><input type="text" name="id" placeholder="Enter new student ID" style="width: auto;"></td>
                <td><input type="text" name="name" placeholder="Enter new student name" style="width: auto;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <input type="submit" value="Add" style="width: auto;">
                </td>
            </tr>

        </table>

    </div>


</body>

</html>