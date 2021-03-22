<?php
include "../includes/db.inc.php";
    /*
    *   For CSRF token
    */
include "links/head.php";
include "links/nav.php";
$_SESSION['token'] = bin2hex(random_bytes(32));

if(!isset($_SESSION['user_id']))
{
    header("location: ../login.php");
}

?>
    <style>
        small {
            font-weight: bolder;
        }
    </style>
    <div class="title">
        <p class="display-3 text-center" id="heading">Role Assignment</p>
    </div>
    <div class="card m-5">
        <div class="card-header">
            <h3 class="pt-2">Roles</h3>
        </div>
        <form action="includes/role.inc.php" method="POST">
            <div class="card-body">
                <!-- For Cross Site Reference Forgery Token -->
                <input type="hidden" id="token" name="role_token" value="<?php echo $_SESSION['token'] ?>">
                <!-- For Role Name -->
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" id="name" name="role" class="form-control" placeholder="Please enter role name">
                    <small>Eg. Manager</small>
                </div>
                <!-- For Role Name -->
                <div class="form-group">
                    <label for="desc">Role Description</label>
                    <textarea id="desc" name="desc" class="form-control" placeholder="Please enter a role description"></textarea>
                    <small>This is required</small>
                </div>
            </div>
        </form>
    </div>
    <?php
        if(isset($error))
        {
            foreach($error as $err)
            {
                echo $err;
            }
        }
    ?>
    <div class="card-footer m-5">
        <!-- Submit buttons -->
        <div class="row">
            <input type="submit" name="role_insert" id="insert" class="btn btn-outline-primary float-right ml-3" value="Insert Role">
            <input type="reset" name="reset" id="reset" class="btn btn-outline-danger float-right ml-3">
        </div>
    </div>
    </form>
    </div>
<?php
    include 'links/foot.php';
?>