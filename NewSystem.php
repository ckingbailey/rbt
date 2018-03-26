<?php
include('session.php');
$title = "SVBX - Add New System";
include('filestart.php');
    if($Role == 'U' OR $Role == 'V') {
        header('location: unauthorised.php');
    }
    ?>
        <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Add New System</h1>
        </div>
    </div>
        <div class="container"> 
        <FORM action="RecSystem.php" method="POST">
            <table class='usertable'>
                <tr class='usertr'>
                    <th class='userth'>System Name:</th>
                    <td class='usertd'>
                        <input type="text" name="System" maxlength="50" required/>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg' style='margin-left:40%' />
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </FORM>
        </div>
<?php include('fileend.php') ?>