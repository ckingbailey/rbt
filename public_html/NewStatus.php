<?php
include('session.php');
$title = "SVBX - Add New Status Type";
include('filestart.php');
    if($_SESSION['role'] < 30) {
        header('location: unauthorised.php');
    }
    ?>
        <header class="page-header container">
          <h1 class="page-title">Add New Status type</h1>
        </header>
        <div class="container main-content">
        <form action="RecStatus.php" method="POST">
            <table class='table svbx-table'>
                <tr class='usertr'>
                    <th class='userth'>Status Type Name:</th>
                    <td class='usertd'>
                        <input type="text" name="statusName" maxlength="25" required/>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </form>
        </div>
<?php include('fileend.php') ?>
