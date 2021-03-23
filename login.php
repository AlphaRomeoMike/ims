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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Login</title>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        small {
            font-weight: bolder;
        }
    </style>
</head>
<body class="container">
    <div class="title">
        <p class="display-3 text-center" id="heading">Inventory Portal Login</p>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="pt-2">Login</h3>
        </div>
            <form action="includes/login-inc.php" method="POST">
                <div class="card-body">
                <!-- For Cross Site Reference Forfgery Token -->
                <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token'] ?>">
                <!-- For Username/Email -->
                    <div class="form-group">
                        <label for="logincredentials">Username or Email</label>
                        <input type="text" name="cred" id="logincredentials" placeholder="Enter username or email" class="form-control">
                        <small>Eg. "Shafi287" or "shafi257@gmail.com"</small>
                    </div>
                    <!-- For Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control">
                        <small>Your unique password</small>
                    </div>
                </div>
                <?php
                    if (isset($_SESSION['login_error']))
                    {
                        foreach($_SESSION['login_error'] as $err)
                        {
                            echo $err;
                        }
                        unset($_SESSION['login_error']);
                    }
                ?>
                <div class="card-footer">
                    <!-- Submit buttons -->
                    <div class="row">
                        <input type="submit" name="login" id="login" class="btn btn-outline-primary float-right ml-3" value="Login">
                        <input type="reset" name="reset" id="reset" class="btn btn-outline-danger float-right ml-3">
                    </div>
                </div>
            </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>