<?php
include('session.php');
$title = "SVBX - Add New Location";
include('filestart.php');
    if ($Role <= 20) {
        header('location: unauthorised.php');
    }
    ?>
        <header class="container page-header">
          <h1 class="page-title">Add New Location</h1>
        </header>
    </div>
        <div class="container main-content">
        <FORM action="RecLocation.php" method="POST">
            <table class='table svbx-table'>
                <tr class='usertr'>
                    <th class='userth'>Location Name:</th>
                    <td class='usertd'>
                        <input type="text" name="LocationName" maxlength="50" required/>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </FORM>
        </div>
<?php include('fileend.php') ?>
