<?php 
    include('session.php');
    include('sql_functions/sqlFunctions.php');
    $table = 'severity';
    $q = $_POST["q"];
    $title = "SVBX - Update Severity";
    $Loc = "SELECT SeverityName, severityDescrip FROM $table WHERE SeverityID = ".$q;
    include('filestart.php');
    $link = f_sqlConnect();
    
    if($Role <= 20) {
        header('location: unauthorised.php');
    }
?>
        <header class="container page-header">
            <h1 class="page-title">Update Severity</h1>
        </header>
<?php       if($stmt = $link->prepare($Loc)) {
            $stmt->execute();
            $stmt->bind_result($SeverityName, $Description);
            while ($stmt->fetch()) {
                echo "
                    <div class='container'> 
                        <form action='UpdateSeverityCommit.php' method='POST'>
                            <input type='hidden' name='SeverityID' value='$q'>
                            <table class='table'>
                                <tr class='usertr'>
                                    <th class='userth'>Severity Name:</th>
                                    <td class='usertd'>
                                        <input type='text' name='SeverityName' maxlength='50' required value='$SeverityName'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th coldpan='2' class='userth'>Severity Description:</th>
                                    <td class='usertd'>
                                        <textarea type='message'  rows='5' cols='99%' name='Description' max='255' required>$Description</textarea>
                                    </td>
                                </tr>
                            </table>
                            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
                            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
                        </form>
                    </div>";
                }
            } else {
                echo '<br>Unable to connect';
                exit();
            }
        include('fileend.php') ?>