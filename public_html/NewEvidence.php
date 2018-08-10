<?php
include('session.php');
$title = "SVBX - Add New Evidence Type";
include('filestart.php');
    if($_SESSION['role'] < 20) {
        header('location: unauthorised.php');
        exit;
    }
    ?>
        <header class="container page-header">
          <h1 class="page-title">Add New Evidence type</h1>
        </header>
    </div>
        <div class="container main-content">
        <FORM action="RecEvidence.php" method="POST">
            <table class='table svbx-table'>
                <tr class='usertr'>
                    <th class='userth'>Evidence Type Name:</th>
                    <td class='usertd'>
                        <input type="text" name="EviTypeName" maxlength="50" required/>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </FORM>
        </div>
<?php include('fileend.php') ?>
