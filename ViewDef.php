<?php
include('session.php');
$DefID = $_GET['DefID'];
$Role = $_SESSION['Role'];
$title = "SVBX - Deficiency No".$DefID;
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include('filestart.php'); 
$link = f_sqlConnect();
$Def = file_get_contents("ViewDef.sql").$DefID;

    if($stmt = $link->prepare($Def)) {  
        $stmt->execute();  
        $stmt->bind_result(
                $OldID, 
                $Location, 
                $SpecLoc, 
                $Severity, 
                $Description, 
                $Spec, 
                $DateCreated, 
                $Status, 
                $IdentifiedBy, 
                $SystemAffected, 
                $GroupToResolve, 
                $ActionOwner, 
                $EvidenceType, 
                $EvidenceLink, 
                $DateClosed, 
                $LastUpdated, 
                $Updated_by, 
                $Created_by, 
                $Comments,
                $RequiredBy,
                $Repo,
                $filename,
                $ClosureComments,
                $DueDate,
                $SafetyCert);  
    while ($stmt->fetch()) { 
    
    echo "
            <table class='vdtable'>
                <tr class='vdtr'>";
                    if($Status == "Open") {
                        $color = "Red";
                    } elseif($Status == "Closed") {
                        $color = "Green"; 
                        } else {
                            $color = "Black";
                        }
            echo "        <th class='vdth' colspan='4' height='50' style='background-color:$color'><p>
                        Deficiency No. $DefID</p></th>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'><p>Required Information</p></th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Safety Certifiable:</p></td>
                    <td class='vdtda'><p>";
                        if($SafetyCert == '1') {
                            $SafetyCert = 'Yes';
                        } elseif($SafetyCert == '2') {
                            $SafetyCert = 'No';
                        } else {
                            $SafetyCert = '';
                        }
                    echo " $SafetyCert</p></td>
                    <td class='vdtdh'><p>System Affected:</p></td>
                    <td class='vdtd'><p>$SystemAffected</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>General Location:</p></td>
                    <td class='vdtda'><p>$Location</p></td>
                    <td class='vdtdh'><p>Specific Location:</p></td>
                    <td class='vdtda'><p>$SpecLoc</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Status:</p></td>
                    <td class='vdtda'><p>$Status</p></td>
                    <td class='vdtdh'><p>Severity:</p></td>
                    <td class='vdtda'><p>$Severity</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Due Date:</p></td>
                    <td class='vdtda'><p>$DueDate</p></td>
                    <td class='vdtdh'><p>Resolution required by:</p></td>
                    <td class='vdtda'><p>$RequiredBy</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Group to Resolve:</p></td>
                    <td class='vdtda'><p>$GroupToResolve</p></td>
                    <td class='vdtdh'><p>Identified By:</p></td>
                    <td class='vdtda'><p>$IdentifiedBy</p></td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style='text-align:center' class='vdtd'><p>Deficiency Description</p></td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4><p>"; echo nl2br($Description);
                    echo "</p></td>
                </tr>
                <t class='vdtr'>
                    <th colspan='4' class='vdth'><p>Optional Information</p></th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Spec or Code:</p></td>
                    <td colspan='3' class='vdtd'><p>$Spec</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Action Owner:</p></td>
                    <td class='vdtda'><p>$ActionOwner</p></td>
                    <td class='vdtdh'><p>Old Id:</p></td>
                    <td class='vdtda'><p>$OldID</p></td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style='text-align:center' class='vdtd'><p>Additional Information</p></td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4><p>"; echo nl2br($Comments);
                    echo "</p></td>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'><p>Closure Information</p></th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Evidence Type:</p></td>
                    <td class='vdtda' colspan='3'><p>$EvidenceType</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Evidence Repository:</p></td>
                    <td class='vdtda'><p>";
                    if($Repo == '1') {
                            $Repo = 'SharePoint';
                        } else {
                            $Repo = 'Aconex';
                        }
                    echo "    
                        $Repo</p></td>
                    <td class='vdtdh'><p>Repository No:</p></td>
                    <td class='vdtda'><p>$EvidenceLink</p></td>
                </tr>
                 <tr class='vdtr'>
                    <td colspan='4' style='text-align:center' class='vdtd'><p>Closure Comments</p></td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4><p>"; echo nl2br($ClosureComments);
                    echo "</p></td>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' style='text-align:center' class='vdth'><p>Modification Details</p></th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Date Created:</p></td>
                    <td class='vdtda'><p>$DateCreated</p></td>
                    <td class='vdtdh'><p>Created by:</p></td>
                    <td class='vdtda'><p>$Created_by</p></td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtdh'><p>Last Updated:</p></td>
                    <td class='vdtda'><p>$LastUpdated</p></td>
                    <td class='vdtdh'><p>Updated by:</p></td>
                    <td class='vdtda'><p>$Updated_by</p></td>
                </tr>
            </table><br>";
            if($Role == 'S' OR $Role == 'A' OR $Role == 'U') 
            {
                echo "
                    <form action='UpdateDef.php' method='POST' onsubmit='' style='text-align:center' />
                    <input type='hidden' name='q' value='".$DefID."'/>
                    <input type='submit' name='submit' value='Update' class='btn btn-primary btn-lg'/>
                    </form>
                    <br />
                    <br />";
            } else {
                
            }
                    }  
                } else {  
                    echo "
                    <div='container'>
                    <br />
                    <br />
                    <br />
                    <br>Unable to connect<br>
                    </div>";
                    echo $Def.'<br /><br />';
                    //echo mysqli_error();
                    //echo "<BR>Def ID: ".$DefID;
                  exit();  
                } 
    include('fileend.php');
    MySqli_Close($link); 
?>