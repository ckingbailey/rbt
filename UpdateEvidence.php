<?php 
    include('SQLFunctions.php');
    $link = f_sqlConnect();
    $table = EvidenceType;
    $q = $_POST["q"];
    $title = "SVBX - Update Evidence Type";
    $Loc = "SELECT EviType FROM $table WHERE EviTypeID = ".$q;
    include('filestart.php'); 
    
    if($Role == 'U' OR $Role == 'V' OR $Role == '') {
        header('location: unauthorised.php');
    }
?>
        <div class="container page-header">
            <h1 class="page-title">Update Evidence Type</h1>
        </div>
        <?php       
            if($stmt = $link->prepare($Loc)) {
                $stmt->execute();
                $stmt->bind_result($EviType);
                while ($stmt->fetch()) {
                    echo "
                        <div class='container main-content'> 
                            <FORM action='UpdateEvidenceCommit.php' method='POST'>
                                <input type='hidden' name='EviTypeID' value='".$q."'>
                                <table class='table'>
                                    <tr class='usertr'>
                                        <th class='userth'>Evidence Type Name:</th>
                                        <td class='usertd'>
                                            <input type='text' name='EviType' maxlength='50' required value='".$EviType."'/>
                                        </td>
                                    </tr>
                                </table>
                                <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
                                <input type='reset' value='reset' class='btn btn-primary btn-lg' /><br />
                            </FORM>
                        </div>";
                }
            } else {
                echo '<br>Unable to connect';
                exit();
            }
        include('fileend.php') ?>
