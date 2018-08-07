<?php
include('session.php');
$title = "SVBX - Add New Severity Type";
include('filestart.php');
if($_SESSION['role'] < 30) {
    header('location: unauthorised.php');
    exit;
}
?>
        <header class="container page-header">
          <h1 class="page-title">Add New Severity type</h1>
        </header>
    </div>
        <div class="container main-content">
        <FORM action="RecSeverity.php" method="POST">
            <table class='table svbx-table'>
                <tr class='usertr'>
                    <th class='userth'>Severity Name:</th>
                    <td class='usertd'>
                        <input type="text" name="severityName" maxlength="12" required/>
                    </td>
                </tr>
                <tr class='usertr'>
                    <th class='userth'>Description:</th>
                    <td class='usertd'>
                        <textarea rows="5" cols='50' name="severityDescrip" max="255" required></textarea>
                    </td>
                </tr>
            </table>
            <br/>
            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </FORM>
        </div>
<?php include('fileend.php') ?>
