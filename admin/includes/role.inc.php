<?php
session_start();

include '../../includes/db.inc.php';
include '../../includes/validate.inc.php';

//* CHECK FOR CSRF
if($_POST['token'] == $_SESSION['token'] && isset($_POST['role_insert']))
{
    $role_name = $_POST['role'];
    $role_desc = $_POST['desc'];

    if(empty($role_name) || empty($role_desc))
    {
        array_push($error, '<p class="alert alert-danger">Please enter both fields</p>');
    }
    else 
    {
        $role_name = clean($role_name);
        $role_desc = clean($role_desc);
        var_dump($role_name, $role_desc);
        die();
        // $stmt = $con->prepare("INSERT INTO roles (Name, Description, CreatedBy) VALUES (?, ?, ?)");
        // $stmt->bind_param('ssi', );
    }
}