<?php 
    include('session.php');
    include('SQLFunctions.php');
    $link = f_sqlConnect();
    $table = System;
    $q = $_POST["q"];
    $title = "SVBX - Update System";
    $Loc = "SELECT System FROM $table WHERE SystemID = ".$q;
    include('filestart.php');
    
    if($Role == 'U' OR $Role == 'V') {
        header('location: unauthorised.php');
    }
?>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Update System</h1>
        </div>
    </div>
        <?php       
            if($stmt = $link->prepare($Loc)) {
                $stmt->execute();
                $stmt->bind_result($System);
                while ($stmt->fetch()) {
                    echo "
                        <div class='container'> 
                            <FORM action='UpdateSystemCommit.php' method='POST'>
                                <input type='hidden' name='SystemID' value='".$q."'>
                                <table class='usertable'>
                                    <tr class='usertr'>
                                        <th class='userth'>System Name:</th>
                                        <td class='usertd'>
                                            <input type='text' name='System' maxlength='50' required value='".$System."'/>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <input type='submit' value='submit' class='btn btn-primary btn-lg' style='margin-left:40%' />
                                <input type='reset' value='reset' class='btn btn-primary btn-lg' />
                            </FORM>
                        </div>";
                }
            } else {
                echo '<br>Unable to connect';
                exit();
            }
        include('fileend.php') ?>
