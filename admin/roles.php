<?php
include "../includes/db.inc.php";
    /*
    *   For CSRF token
    */
include "links/head.php";
include "links/nav.php";
$_SESSION['role_token'] = bin2hex(random_bytes(32));

if (!isset($_SESSION['user_id'])) {
    header("location: ../login.php");
}

?>

<!-- TITLE -->
<div class="title">
    <div class="display-3 text-center">IMS Role Creation</div>
</div>

<!-- FORM -->
<div class="container">
    <div class="card mt-5">
        <div class="card-header">Enter Role Details</div>

        <form action="includes/role.inc.php" class="form" method="post" autocomplete="FALSE" autocapitalize="sentenses">
            <div class="card-body">
                <!-- FOR CSRF TOKEN AUTH -->
                <input type="hidden" name="role_token" autocomplete="false" value="<?php echo $_SESSION['role_token']; ?>">

                <div class="form-group">
                    <label for="role_name">Role Name</label>
                    <input type="text" name="role_name" class="form-control" autocomplete="false">
                    <small>Eg. Admin</small>
                </div>

                <div class="form-group">
                    <label for="role_desc">Role Description</label>
                    <input type="text" name="role_description" class="form-control" autocomplete="false">
                    <small>This is required</small>
                </div>
            </div>
            <?php
            //* PRINT IF ERROR IS SET 
                if(isset($_GET['err']) == 1)
                {
                    echo '<p class="alert alert-warning">All fields are required</p>';
                }
                else if(isset($_GET['err']) == 2)
                {
                    echo '<p class="alert alert-warning">This role name already exists</p>';
                }
                else if(isset($_GET['err']) == 3)
                {
                    echo '<p class="alert alert-warning">Nice try hacker</p>';
                }
                else if(isset($_GET['suc']))
                {
                    echo '<p class="alert alert-success">Role has been inserted</p>';
                }
            ?>
            <div class="card-footer">
                <input type="submit" value="Insert Role" name="role_insert" class="btn btn-outline-primary mr-3">
                <input type="reset" value="Reset" class="btn btn-outline-danger mr-3">
            </div>
        </form>

    </div>
</div>
</div>
<?php
include 'links/foot.php';
?>