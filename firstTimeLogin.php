<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">
<html lang="en">

<head>
    <header>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Tab Title-->
        <title>Project Database</title>

        <div class="container" style="text-align: center;">
            <h1>First Time Login In, Please Change Password</h1>
            <small>Founded by Hazim, Norman and Danish  </small>
        </div>
    </header>
</head>

<body>
    <div class="container">

        <div class="col-3" style="margin:auto ">
            <!-- image for fun -->
            <div class="text-center">
                <img src="TheGeng.PNG" alt="cubateka.PNG" style="width: 300px; height: 200px; margin-top: 30px;">
            </div>
            <!--Style to create box-->
            <div style="border: 2px solid black; padding: 15px; width: 375px;">
                <form action="passwordChanger.php" method = "POST" style="padding-top: 15px ; width: 350px;">
                    <!--path file jangan lupa-->

                    <!-- ID and Password -->
                    <label for="id">New Password :</label>
                    <input type="password" id="pass" name="password" placeholder="Enter new password" required>
                    <br><br>
                    <label for="password">Confirm Password :</label>
                    <input type="password" id="pass" name="pass" placeholder="Confirm new password" required><br>
                    <br>
                    <!--Button-->
                    <input type="submit" value="Submit" class="btn btn-default btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>