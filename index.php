<?php
include "includes/db.inc.php";
/*
    *   For CSRF token
    */
session_start();
$_SESSION['token'] = bin2hex(random_bytes(32));
if(isset($_SESSION['user_name']))
{
    header("location: admin/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventory Portal</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        small {
            font-weight: bolder;
        }
    </style>
</head>

<body class="container">
    <div class="title">
        <p class="display-3 text-center" id="heading">Inventory portal</p>
    </div>

    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="pt-2">Signup</h3>
        </div>
        <div class="card-body">
            <form action="includes/reg.inc.php" method="post" id="register" autocomplete="FALSE">
                <!-- For Cross Site Reference Forfgery Token -->
                <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token'] ?>"
                <!-- For Name -->
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
                <small>Eg. Muhammad Ali</small> <br><br>
                <!-- For Username -->
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
                <small>Your username should be unique</small><br><br>
                <!-- For Email -->
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                <small>Your email should be unique</small><br><br>
                <!-- For Password -->
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                <small>Your password should be unique and should contain atleast 2 numbers</small><br><br>
                <!-- For Confirm Password -->
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Confirm your password">
                <small>Your password should be unique and should match the upper password</small><br><br>
                <!-- PHP FOR DISPLAYING ERRORS -->
                <?php
                if (isset($_SESSION['error'])) 
                {
                    $err = (array)$_SESSION['error'];
                    foreach($err as $er)
                    {
                        ?>
                            <span><?php echo $er ?></span>
                        <?php
                    }
                }

                ?>
        </div>
                <!-- Submit and Reset buttons -->
                <div class="card-footer">
                    <div class="row">
                        <input type="submit" name="submit" id="submit" class="btn btn-outline-primary float-right">
                        <input type="reset" name="reset" id="reset" class="btn btn-outline-warning float-right ml-3">
                    </div>
                </div>
        </form> 
    </div>
    <div class="m-4"></div>
    </div>

    <script>
        $(document).ready(function() {});
    </script>
</body>

</html>