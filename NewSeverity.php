<?php
include('session.php');
$title = "SVBX - Add New Severity Type";
include('filestart.php');
if($Role == 'U' OR $Role == 'V' OR $Role == 'A') {
        header('location: unauthorised.php');
    }
?>
        <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Add New Severity type</h1>
        </div>
    </div>
        <div class="container"> 
        <FORM action="RecSeverity.php" method="POST">
            <table class='usertable'>
                <tr class='usertr'>
                    <th class='userth'>Evidence Type Name:</th>
                    <td class='usertd'>
                        <input type="text" name="EviType" maxlength="50" required/>
                    </td>
                </tr>
                <tr class='usertr'>
                    <th class='userth'>Description:</th>
                    <td class='usertd'>
                        <textarea type="message"  rows="5" cols="99%" name="Description" max="255" required></textarea>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg' style='margin-left:40%' />
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </FORM>
        </div>
<?php include('fileend.php') ?>