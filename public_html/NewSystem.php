<?php
include('session.php');
$title = "SVBX - Add New System";
include('filestart.php');
    if($Role <= 20) {
        header('location: unauthorised.php');
    }
    ?>
        <header class="container page-header">
          <h1 class="page-title">Add New System</h1>
        </header>
        <div class="container main-content">
        <FORM action="RecSystem.php" method="POST">
            <table class='table svbx-table'>
                <tr class='usertr'>
                    <th class='userth'>System Name:</th>
                    <td class='usertd'>
                        <input type="text" name="SystemName" maxlength="50" required/>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </FORM>
        </div>
<?php include('fileend.php') ?>
