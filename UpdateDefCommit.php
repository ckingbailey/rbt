<?php
include('SQLFunctions.php');
include('session.php');

if(!empty($_POST)) {
    $link = f_sqlConnect();
    $DefID = $_POST['DefID'];
    $SystemAffected = $_POST['SystemAffected'];
    $LocationName = $_POST['LocationName'];
    $SpecLoc = $link->real_escape_string($_POST['SpecLoc']);
    $Status = $_POST['Status'];
    $SeverityName = $_POST['SeverityName'];
    $GroupToResolve = $_POST['GroupToResolve'];
    $IdentifiedBy = $link->real_escape_string($_POST['IdentifiedBy']);
    $Description = $link->real_escape_string($_POST['Description']);
    $EvidenceType = $_POST['EviType'];
    $EvidenceLink = $link->real_escape_string($_POST['EvidenceLink']);
    $ActionOwner = $link->real_escape_string($_POST['ActionOwner']);
    $OldID = $link->real_escape_string($_POST['OldID']);
    $Comments = $link->real_escape_string($_POST['Comments']);
    $Spec = $link->real_escape_string($_POST['Spec']);
    $ClosureComments = $link->real_escape_string($_POST['ClosureComments']);
    $RequiredBy = $_POST['RequiredBy'];
    $Repo = $_POST['Repo'];
    $Pics = $_POST['Pics'];
    $DueDate = $_POST['DueDate'];
    $SafetyCert = $_POST['SafetyCert'];
    $UserID = $_SESSION['UserID'];
    $Username = $_SESSION['Username'];
    
    
    $sql = "UPDATE CDL
            SET  
                 OldID = '".$OldID."'
                ,Location = '".$LocationName."'
                ,SpecLoc = '".$SpecLoc."'
                ,Severity = '".$SeverityName."'
                ,Description = '".$Description."'
                ,Spec = '".$Spec."'
                ,Status = '".$Status."'
                ,IdentifiedBy = '".$IdentifiedBy."'
                ,SystemAffected = '".$SystemAffected."'
                ,GroupToResolve = '".$GroupToResolve."'
                ,ActionOwner = '".$ActionOwner."'
                ,EvidenceType = '".$EvidenceType."'
                ,EvidenceLink = '".$EvidenceLink."'
                ,Comments = '".$Comments."'
                ,SafetyCert = '".$SafetyCert."'
                ,Requiredby = '".$RequiredBy."'
                ,Repo = '".$Repo."'
                ,Pics = '".$Pics."'
                ,ClosureComments = '".$ClosureComments."'
                ,DueDate = '".$DueDate."'
                ,Updated_by = '".$Username."'
                ,LastUpdated = NOW()
            WHERE DefID = ".$DefID.";";

            if(mysqli_query($link,$sql)) {
                echo "<br>Update Completed successfully";
        } else {
            echo "<br>Error: " .$sql. "<br>" .mysqli_error($link);
        }
        mysqli_close($link);
        header("Location: DisplayDefs.php?msg=1");
        //echo "<br>SQL: ".$sql;
        //echo "<br>SafetyCert: ".$SafetyCert;
        //echo "<br>Repo: ".$Repo;
}
?>