<?php
include('session.php');
$title = "SVBX - Update Deficiency";
include('filestart.php'); 

    $link = f_sqlConnect();
    $q = $_POST['q'];
    $Def = file_get_contents("UpdateDef.sql").$q;
    error_reporting(E_ALL);  
    ini_set("display_errors", 1);
    $sql1 = "SELECT LocationID, LocationName FROM Location ORDER BY LocationName";
    $list1 = mysqli_query($link,$sql1);
    $sql2 = "SELECT SystemID, System FROM System ORDER BY System";
    $list2 = mysqli_query($link,$sql2);
    $sql3 = "SELECT StatusID, Status FROM Status WHERE StatusID <> 3 ORDER BY StatusID";
    $list3 = mysqli_query($link,$sql3);
    $sql4 = "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName";
    $list4 = mysqli_query($link,$sql4);
    $sql5 = "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType";
    $list5 = mysqli_query($link,$sql5);
    $sql6 = "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY RequiredBy";
    $list6 = mysqli_query($link,$sql6);
    $sql7 = "SELECT RepoID, Repo FROM Repo ORDER BY Repo";
    $list7 = mysqli_query($link,$sql7);
    $sql8 = "SELECT YesNoID, YesNo FROM YesNo ORDER BY YesNo";
    $list8 = mysqli_query($link,$sql8);
    
    
    
    
    if($stmt = $link->prepare($Def)) {  
        $stmt->execute();  
        $stmt->bind_result(
            $OldID, 
            $Location, 
            $SpecLoc, 
            $Severity, 
            $Description, 
            $Spec, $DateCreated, 
            $Status, $IdentifiedBy, 
            $SystemAffected, 
            $GroupToResolve, 
            $ActionOwner, 
            $EvidenceType, 
            $EvidenceLink, 
            $DateClosed, 
            $LastUpdated, 
            $Updated_by, 
            $Comments, 
            $RequiredBy, 
            $Repo, 
            $Pics, 
            $ClosureComments, 
            $DueDate, 
            $SafetyCert);  
    while ($stmt->fetch()) {
    echo "
        <header class='container page-header'>
            <h1 class='page-title'>Clone Deficiency ".$q."</h1>
        </header>
        <main class='container main-content'> 
        <form action='RecDef.php' method='POST' onsubmit='' />
            <table class='table svbx-table'>
                <tr class='vdtr'>
                <th colspan='4' height='50' class='vdth'><p>
                        Clone Deficiency</p></th>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'><p>Required Information</p></th>
                </tr>
                <td class='vdtd'>
                        <p>Safety Certifiable:</p>
                    </td>
                <td class='vdtda'><select name='SafetyCert' value='".$SafetyCert."' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list8) || is_object($list8)) {
                        foreach($list8 as $row) {
                            echo "<option value='$row[YesNoID]'";
                                if($row['YesNoID'] == $SafetyCert) {
                                    echo " selected>$row[YesNo]</option>";
                                    } else { echo ">$row[YesNo]</option>";
                                }
                        }
                        }
                    echo "
                    </td>
                    <td class='vdtdh'><p>System Affected:</p></td>
                    <td class='vdtda'><select name='SystemAffected' value='".$SystemAffected."' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list2) || is_object($list2)) {
                        foreach($list2 as $row) {
                            echo "<option value='$row[SystemID]'";
                                if($row['SystemID'] == $SystemAffected) {
                                    echo " selected>$row[System]</option>";
                                    } else { echo ">$row[System]</option>";
                                }
                        }
                        }
    echo "      </td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>General Location:</p></td>
                    <td class='vdtda'><select name='Location' value='' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list1) || is_object($list1)) {
                        foreach($list1 as $row) {
                            echo "<option value='$row[LocationID]'>$row[LocationName]</option>";
                                }
                        }
    echo "          </td>
                    <td class='vdtdh'><p>Specific Location:</p></td>
                    <td class='vdtda'><p><input type='text' name='SpecLoc' value='".$SpecLoc."' max='55' id='defdd'/></p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Status:</p></td>
                    <td class='vdtda'><select name='Status' value='".$Status."' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list3) || is_object($list3)) {
                        foreach($list3 as $row) {
                            echo "<option value='$row[StatusID]'";
                                if($row['StatusID'] == $Status) {
                                    echo " selected>$row[Status]</option>";
                                    } else { echo ">$row[Status]</option>";
                                }
                        }
                        }
    echo "          </td>
                    <td class='vdtdh'><p>Severity:</p></td>
                    <td class='vdtda'><select name='Severity' value='".$Severity."' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list4) || is_object($list4)) {
                        foreach($list4 as $row) {
                            echo "<option value='$row[SeverityID]'";
                                if($row['SeverityID'] == $Severity) {
                                    echo " selected>$row[SeverityName]</option>";
                                    } else { echo ">$row[SeverityName]</option>";
                                }
                        }
                        }
    echo "      </td>
                </tr>
                <tr class='vdtr'>    
                    <td class='vdtdh'>
                        <p>To be resolved by:</p>
                    </td>
                    <td class='vdtd'>
                        <input type='date' name='DueDate' id='defdd' value='$DueDate' required/>
                    </td>
                    <td class='vdtdh'>
                        <p>Required for:</p>
                    </td>
                    <td class='vdtda'><select name='RequiredBy' value='".$RequiredBy."' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list6) || is_object($list6)) {
                        foreach($list6 as $row) {
                            echo "<option value='$row[ReqByID]'";
                                if($row['ReqByID'] == $RequiredBy) {
                                    echo " selected>$row[RequiredBy]</option>";
                                    } else { echo ">$row[RequiredBy]</option>";
                                }
                        }
                        }
    echo "
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Group to Resolve:</p></td>
                    <td class='vdtda'><select name='GroupToResolve' value='".$GroupToResolve."' id='defdd'></option>
                        <option value=''></option>";
                        if(is_array($list2) || is_object($list2)) {
                        foreach($list2 as $row) {
                            echo "<option value='$row[SystemID]'";
                                if($row['SystemID'] == $GroupToResolve) {
                                    echo " selected>$row[System]</option>";
                                    } else { echo ">$row[System]</option>";
                                }
                        }
                        }
    echo "          </td>
                    <td class='vdtdh'><p>Identified By:</p></td>
                    <td class='vdtda'><input type='text' name='IdentifiedBy' value='".$IdentifiedBy."' max='24' id='defdd'/></td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style='text-align:center' class='vdtdh'><p>Deficiency Description</p></th>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4  style='text-align:center'><textarea type='message' rows='5' cols='99%' name='Description' max='1000'>$Description</textarea></td>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'><p>Optional Information</p></th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Spec or Code:</p></td>
                    <td class='vdtda' colspan='3'><input type='text' name='Spec' value='".$Spec."' max='24'/></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Action Owner:</p></td>
                    <td class='vdtda'><input type='text' name='ActionOwner' value='".$ActionOwner."' max='24'/></td>
                    <td class='vdtdh'><p>Old Id:</p></td>
                    <td class='vdtda'><input type='text' name='OldID' value='".$OldID."' max='24'/></td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style='text-align:center' class='vdtdh'>
                        <p>More Information</p>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4 class='vdtda' style='text-align:center'>
                        <textarea type='message'  rows='5' cols='99%' name='comments' max='1000'>$Comments</textarea>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4'th class='vdth'><p>Closure Information</p></th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Evidence Type:</p></td>
                    <td class='vdtda' colspan='3'>
                    <select name='EvidenceType' value='".$EvidenceType."'></option>
                        <option value=''></option>";
                        if(is_array($list5) || is_object($list5)) {
                        foreach($list5 as $row) {
                            echo "<option value='$row[EviTypeID]'";
                                if($row['EviTypeID'] == $EvidenceType) {
                                    echo " selected>$row[EviType]</option>";
                                    } else { echo ">$row[EviType]</option>";
                                }
                        }
                        }
    echo "          </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'>
                        <p>Evidence Repository:</p>
                    </td>
                    <td class='vdtda'>
                    <select name='Repo' value='".$Repo."'></option>
                        <option value=''></option>";
                        if(is_array($list7) || is_object($list7)) {
                        foreach($list7 as $row) {
                            echo "<option value='$row[RepoID]'";
                                if($row['RepoID'] == $Repo) {
                                    echo " selected>$row[Repo]</option>";
                                    } else { echo ">$row[Repo]</option>";
                                }
                        }
                        }
    echo "                </td>
                    <td class='vdtdh'>
                        <p>Repository Number</p>
                    </td>
                    <td class='vdtda'>
                        <input type='text' name='EvidenceLink' max='255' value='$EvidenceLink' id='defdd'/>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style='text-align:center'  class='vdtdh'>
                        <p>Closure Comments</p>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4 class='vdtda' style='text-align:center'>
                        <textarea type='message'  rows='5' cols='99%' name='ClosureComments' max='1000'>$ClosureComments</textarea>
                    </td>
                </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg' style='margin-left:40%' />
            <input type='reset' value='reset' class='btn btn-primary btn-lg' /><br /><br />
            </form>
            </div></main>
            ";
            //echo "Description: " .$Description;
            }
        } else {  
            echo "<br>Unable to connect<br>";
            exit();  
        } 
    MySqli_Close($link);             
    include('fileend.php');
?>