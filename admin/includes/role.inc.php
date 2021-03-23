<?php
session_start();
$error = [];
include '../../includes/db.inc.php';
include '../../includes/validate.inc.php';
$token = $_POST['role_token'];
//* CHECK FOR CSRF TOKEN && CHECK FOR BUTTON POST
if($token == $_SESSION['role_token'] && isset($_POST['role_insert']))
{
    //* CHECK FOR EMPTY DATA
    if(empty($_POST['role_name']) || empty($_POST['role_description']))
    {
        //* PUSH ERROR
        array_push($error,'<p class="alert alert-warning">All fields are required</p>');
        header("location: ../roles.php?err=1");
    }
    else 
    {
        //* VALIDATE USER INPUT
        $role_name = clean($_POST['role_name']);
        $role_desc = clean($_POST['role_description']);

        //* CHECK FOR ROLE IF ALREADY PRESENT
        $stmt = $con->prepare("SELECT * FROM roles WHERE Name = ?");
        $stmt->bind_param("s", $role_name);
        $stmt->execute();
        $row = $stmt->get_result();
        //* IF IT HAS NO DATA START INSERTION
        if($row->num_rows == 0) 
        {
            //* START PROCESS FOR INSERTION
            $stmt = $con->prepare("INSERT INTO roles (Name, Description) VALUES (?, ?)");
            $stmt->bind_param("ss", $role_name, $role_desc);
            $stmt->execute();
            $success = '<p class="alert alert-success">Role has been inserted</p>';
            header("location: ../roles.php?suc=1");
        }
        else 
        {
            //* PUSH ERROR
            array_push($error,'<p class="alert alert-warning">This role name already exists</p>');
            header("location: ../roles.php?err=2");
        }
    }
}
else
{
    echo "Nice try hacker";
    header("location: ../roles.php?err=3");
}