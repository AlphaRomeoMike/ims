<?php
// session_start();
include "functions/datetime.php";
include "../includes/db.inc.php";
    /*
    *   For CSRF token
    */
include "links/head.php";
include "links/nav.php";
?>

<button id="swl">A butt</button>

<script>

    $('#swl').on('click', function(){
        Swal.fire();
    })

</script>
<?php
include 'links/foot.php';
?>