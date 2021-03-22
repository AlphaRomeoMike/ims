<?php
session_start();
$_SESSION['login_error'] = [];
$is_err = false;
$login = false;
$error = [];
$regex_password = "/^(?=.*\d).{4,8}$/";
include './db.inc.php';
include './validate.inc.php';

if ($_POST['token'] == $_SESSION['token'] && isset($_POST['login'])) 
{
    $cred       = clean($_POST['cred']);
    $password   = $_POST['password'];
    //* FETCH USER
    $stmt = $con->prepare("SELECT * FROM users WHERE (Username = ? OR Email = ?) LIMIT 1");
    $stmt->bind_param("ss", $cred, $cred);
    $stmt->execute();
    $row = $stmt->get_result();

    //* FETCH USER PASSWORD
    if ($row->num_rows > 0) 
    {
        while ($data = $row->fetch_assoc()) 
        {
            if (password_verify($password, $data['Password'])) 
            {
                $login = true;
                $_SESSION['user_id']    = $data['Id'];
                $_SESSION['username']   = $data['Username'];
                $_SESSION['user_name']  = $data['Name'];
                $_SESSION['role']       = $data['RoleId'];
                header("location: ../admin/index.php");
            } 
            else 
            {
                array_push($error, '<p class="alert alert-danger">Password incorrect</p>');
                $is_err = true;
            }
        }
    } 
    else 
    {
        array_push($error, '<p class="alert alert-danger">No such records found</p>');
        $is_err = true;
    }
    if (!empty($error)) 
    {
        $_SESSION['login_error'] = $error;
    }
} 
if($is_err)
{
    header("location: ../login.php");
}