<?php
    $error = [];
    $regex_username = "(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$";
    $regex_password = "/^(?=.*\d).{4,8}$/";
    $success;
    session_start();
    include './db.inc.php';
    include './validate.inc.php';

    //* CHECK FOR CSRF
    if($_POST['token'] == $_SESSION['token'])
    {
        //* FILTER INPUT FROM USER
        $name       = clean($_POST['name']);
        $username   = clean($_POST['username']);
        $email      = clean($_POST['email']);
        $password   = $_POST['password'];
        $cpassword  = $_POST['cpassword'];
        $token      = $_SESSION['token'];

        //* CHECK FOR EMPTY FIELDS OR EMPTY SESSION ONCE AGAIN
        if(!isset($token) || empty($name) || empty($username) || empty($email) || empty($password) || empty($cpassword))
        {
            $error[] .= '<p class="alert alert-danger">All fields are required</p>';
            //* CHECK IF BOTH PASSWORDS MATCH
            if($password != $cpassword) 
            {
                $error[] .= '<p class="alert alert-danger">Passwords do not match</p>';
            } 
            //* CHECK IF USERNAME IS VALID USERNAME
            if(preg_match($regex_username, $username) != 1)
            {
                $error[] .= '<p class="alert alert-danger">Your username does not meet the criteria for our username, it must be alphanumeric with at least one number, one letter, and be between 6-15 character in length</p>';
            }
            //* CHECK IF PASSWORD IS VALID
            if(preg_match($regex_password, $password)) 
            {
                $error[] .= '<p class="alert alert-danger">Password must be between 4 and 8 digits long and include at least one numeric digit.</p>';
            }
        } 
        else 
        {
            //*  CHECK FOR EXISTING USERS IN DB
            $stmt = $con->prepare("SELECT Username, Email FROM users WHERE Username = ? OR Email = ?");
            $stmt->bind_param('ss', $username, $email);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row == null)
            {
                //* CONVERTING PASSWORD TO A HASH
                echo $password;
                $passwordEnc = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $con->prepare("INSERT INTO users(Name, Username, Email, Password) 
                    VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $username, $email, $passwordEnc);
                $stmt->execute();
                $success = '<p class="alert alert-success">Registered</p>';
                $_SESSION['Registerd'] = $success;
                header("location: ../login.php");
            } 
            else 
            {
                $error[] .= '<p class="alert alert-danger">Username or email already exists</p>';
            }
        }
        if(isset($error))
        {
            $_SESSION['error'] = $error;
            header("location: ../index.php");
        }
    } 
    else 
    {
        header("location: ../index.php");
    }

