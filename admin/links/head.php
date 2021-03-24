<?php
  session_start();

// TODO: ADD USEREMAIL TO THIS SECTION
//   $user_email = $_SESSION['user_email'];
  $user_id      = $_SESSION['user_id'];
  $username     = $_SESSION['username'];
  $user_name    = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IMS Management Portal | Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <style>
    small {
        font-weight: bolder;
    }
</style>
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/style.css">
  <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>

</head>

<body>
