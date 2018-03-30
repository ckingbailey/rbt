<?php 
    include('session.php');
    include('SQLFunctions.php');
    $link = f_sqlConnect();
    $table = Status;
    $q = $_POST["q"];
    $title = "SVBX - Update Status Type";
    $Loc = "SELECT Status FROM $table WHERE StatusID = ".$q;
    include('filestart.php');
    
    if($Role == 'U' OR $Role == 'V') {
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
                            <FORM action='UpdateEvidenceCommit.php' method='POST'>
                                <input type='hidden' name='StatusID' value='".$q."'>
                                <table class='usertable'>
                                    <tr class='usertr'>
                                        <th class='userth'>Evidence Type Name:</th>
                                        <td class='usertd'>
                                            <input type='text' name='EviType' maxlength='50' required value='".$Status."'/>
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
