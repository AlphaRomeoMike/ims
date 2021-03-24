<?php
// session_start();
include "functions/datetime.php";
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
    <div class="display-3 text-center">IMS Role Management</div>
</div>

<!-- TABLE -->
<div class="container">
    <table class="table table-striped">
        <thead>
            <h3 class="text-center mt-5">Roles Manager</h3>
        </thead>
        <tbody>
            <tr>
                <th>S. No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Creation Date</th>
                <th>Updation Date</th>
                <th>Actions</th>
            </tr>

            <!-- PHP START FOR SHOWING TABLE DATA -->
            <?php
            $count = 0;
            $stmt = $con->prepare("SELECT * FROM roles");
            $stmt->execute();
            $row = $stmt->get_result();
            if ($row->num_rows > 0) {
                while ($data = $row->fetch_assoc()) {
            ?>
                    <tr>
                        <td> <?php echo $count++; ?> </td>
                        <td> <?php echo $data["Name"]; ?> </td>
                        <td> <?php echo $data["Description"]; ?> </td>
                        <td> <?php echo formatDate($data["CreatedOn"]); ?> </td>
                        <td> <?php echo ($data["UpdatedOn"] == null) ? "NULL" : formatDate($data["UpdatedOn"]); ?> </td>
                        <td>
                            <button type="submit" name="" class="btn btn-outline-dark" value="<?php echo $data["Id"] ?>" id="edit_role">Edit</button>
                            <button type="submit" name="" class="btn btn-outline-danger" value="<?php echo $data["Id"] ?>" id="delete_role">Delete</button>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
            <!-- PHP END FOR SHOWING TABLE DATA -->
        </tbody>
    </table>
</div>

<script>
    $('#edit_role').on('click', function(){
        Swal.fire({
            type: 'confirm',
            title: 'Are you sure?'
        });
    })
</script>

<?php
include 'links/foot.php';
?>