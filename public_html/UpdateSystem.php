<?php 
    include('session.php');
    include('sql_functions/sqlFunctions.php');
    $table = 'system';
    $q = $_POST["q"];
    $title = "SVBX - Update System";
    $Loc = "SELECT SystemName FROM $table WHERE SystemID = ".$q;
    include('filestart.php');
    $link = f_sqlConnect();
    
    if($Role <= 20) {
        header('location: unauthorised.php');
    }
?>
        <header class="container page-header">
            <h1 class="page-title">Update System</h1>
        </header>
        <?php       
            if($stmt = $link->prepare($Loc)) {
                $stmt->execute();
                $stmt->bind_result($System);
                while ($stmt->fetch()) {
                    echo "
                        <div class='container'> 
                            <FORM action='UpdateSystemCommit.php' method='POST'>
                                <input type='hidden' name='SystemID' value='$q'>
                                <table class='table'>
                                    <tr class='usertr'>
                                        <th class='userth'>System Name:</th>
                                        <td class='usertd'>
                                            <input type='text' name='SystemName' maxlength='55' required value='$System'/>
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
