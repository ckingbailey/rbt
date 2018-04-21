<?php
    $title = "SVBX - Unauthorised";
    include('filestart.php') 
?>
    <header class="container page-header">
        <h1 class="page-title">Unauthorised Access Denied</h1>
        <?php echo "<h6>{$_SESSION['Username']}</h6>"; ?>
    </header>
    <div class='container'> 
        <p style='text-align:center'>You do not have the permissions to access this page</p>    
    </div>
<?php
include('fileend.php'); 
?>
