<?php 
    include('session.php');
    include('sql_functions/sqlFunctions.php');
    $table = 'location';
    $q = $_POST["q"];
    $title = "SVBX - Update Location";
    $Loc = "SELECT LocationName FROM $table WHERE LocationID = ".$q;
    include('filestart.php');
    $link = f_sqlConnect();
    
    if($Role <= 20) {
        header('location: unauthorised.php');
    }
?>
        <header class="container page-header">
            <h1 class="page-title">Update Location</h1>
        </header>
        <?php       
            if($stmt = $link->prepare($Loc)) {
                $stmt->execute();
                $stmt->bind_result($Location);
                while ($stmt->fetch()) {
                    echo "
                        <div class='container main-content'> 
                            <FORM action='UpdateLocationCommit.php' method='POST'>
                                <input type='hidden' name='LocationID' value='".$q."'>
                                <table class='table'>
                                    <tr class='usertr'>
                                        <th class='userth'>Evidence Type Name:</th>
                                        <td class='usertd'>
                                            <input type='text' name='LocationName' maxlength='50' required value='".$Location."'/>
                                        </td>
                                    </tr>
                                </table>
                                <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
                                <input type='reset' value='reset' class='btn btn-primary btn-lg' />
                            </FORM>
                        </div>";
                }
            } else {
                echo '<br>Unable to connect';
                exit();
            }
        include('fileend.php') ?>
