<?php 
    include('session.php');
    include('sql_functions/sqlFunctions.php');
    $table = 'status';
    $q = $_POST["q"];
    $title = "SVBX - Update Status Type";
    $Loc = "SELECT StatusName FROM $table WHERE StatusID = ".$q;
    include('filestart.php');
    $link = f_sqlConnect();
    
    if($Role <= 20) {
        header('location: unauthorised.php');
    }
?>
        <header class="container page-header">
            <h1 class="page-title">Update Status Type</h1>
        </header>
        <?php       
            if($stmt = $link->prepare($Loc)) {
                $stmt->execute();
                $stmt->bind_result($Status);
                while ($stmt->fetch()) {
                    echo "
                        <div class='container'> 
                            <FORM action='UpdateStatusCommit.php' method='POST'>
                                <input type='hidden' name='StatusID' value='".$q."'>
                                <table class='table'>
                                    <tr class='usertr'>
                                        <th class='userth'>Status Name:</th>
                                        <td class='usertd'>
                                            <input type='text' name='StatusName' maxlength='50' required value='".$Status."'/>
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
