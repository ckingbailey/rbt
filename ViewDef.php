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
            if($Status == "Open") {
                $color = "bg-red text-white";
            } else {
                $color = "bg-success text-white"; 
            }
            echo "
                <header class='container page-header'>
                    <h1 class='page-title $color pad'>Deficiency No. $DefID</h1>
                </header>
                <main class='container main-content'>
                    <table class='table svbx-table'>
                        <tr class='vdtr'>
                            <th colspan='4' class='vdth'>Required Information</th>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Safety Certifiable:</td>
                            <td class='vdtda'>";
                                if($SafetyCert == '1') {
                                    $SafetyCert = 'Yes';
                                } elseif($SafetyCert == '2') {
                                    $SafetyCert = 'No';
                                } else {
                                    $SafetyCert = '';
                                }
                            echo " $SafetyCert</td>
                            <td class='vdtdh'>System Affected:</td>
                            <td class='vdtda'>$SystemAffected</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>General Location:</td>
                            <td class='vdtda'>$Location</td>
                            <td class='vdtdh'>Specific Location:</td>
                            <td class='vdtda'>$SpecLoc</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Status:</td>
                            <td class='vdtda'>$Status</td>
                            <td class='vdtdh'>Severity:</td>
                            <td class='vdtda'>$Severity</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Due Date:</td>
                            <td class='vdtda'>$DueDate</td>
                            <td class='vdtdh'>Resolution required by:</td>
                            <td class='vdtda'>$RequiredBy</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Group to Resolve:</td>
                            <td class='vdtda'>$GroupToResolve</td>
                            <td class='vdtdh'>Identified By:</td>
                            <td class='vdtda'>$IdentifiedBy</td>
                        </tr>
                        <tr class='vdtr'>
                            <td colspan='4' style='text-align:center' class='vdtda'>Deficiency Description</td>
                        </tr>
                        <tr class='vdtr'>
                            <td Colspan=4 class='vdtda'>"; echo nl2br($Description);
                            echo "</td>
                        </tr>
                        <tr class='vdtr'>
                            <th colspan='4' class='vdth'>Optional Information</th>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Spec or Code:</td>
                            <td colspan='3' class='vdtda'>$Spec</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Action Owner:</td>
                            <td class='vdtda'>$ActionOwner</td>
                            <td class='vdtdh'>Old Id:</td>
                            <td class='vdtda'>$OldID</td>
                        </tr>
                        <tr class='vdtr'>
                            <td colspan='4' style='text-align:center' class='vdtda'>Additional Information</td>
                        </tr>
                        <tr class='vdtr'>
                            <td Colspan=4 class='vdtda'>"; echo nl2br($Comments);
                            echo "</td>
                        </tr>
                        <tr class='vdtr'>
                            <th colspan='4' class='vdth'>Closure Information</th>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Evidence Type:</td>
                            <td class='vdtda' colspan='3'>$EvidenceType</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Evidence Repository:</td>
                            <td class='vdtda'>";
                            if($Repo == '1') {
                                $Repo = 'SharePoint';
                            } elseif ($Repo == 2) {
                                $Repo = 'Aconex';
                            } else $Repo = '';
                            echo "    
                                $Repo</td>
                            <td class='vdtdh'>Repository No:</td>
                            <td class='vdtda'>$EvidenceLink</td>
                        </tr>
                         <tr class='vdtr'>
                            <td colspan='4' style='text-align:center' class='vdtda'>Closure Comments</td>
                        </tr>
                        <tr class='vdtr'>
                            <td Colspan=4 class='vdtda'>"; echo nl2br($ClosureComments);
                            echo "</td>
                        </tr>
                        <tr class='vdtr'>
                            <th colspan='4' style='text-align:center' class='vdth'>Modification Details</th>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Date Created:</td>
                            <td class='vdtda'>$DateCreated</td>
                            <td class='vdtdh'>Created by:</td>
                            <td class='vdtda'>$Created_by</td>
                        </tr>
                        <tr class='vdtr'>
                            <td class='vdtdh'>Last Updated:</td>
                            <td class='vdtda'>$LastUpdated</td>
                            <td class='vdtdh'>Updated by:</td>
                            <td class='vdtda'>$Updated_by</td>
                        </tr>
                    </table>";
        }
        $stmt->close();
        
        // show photos linked to this Def
        if ($stmt = $link->prepare("SELECT pathToFile FROM CDL_pics WHERE defID=?")) {
            $stmt->bind_param('i', $DefID);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pathToFile);
            
            if ($count = $stmt->num_rows) {
                $collapseCtrl = "<h5 class='grey-bg pad'><a data-toggle='collapse' href='#defPics' role='button' aria-expanded='false' aria-controls='defPics' class='collapsed'>Photos<i class='typcn typcn-arrow-sorted-down'></i></a></h5>";
                $photoSection = sprintf("%s<section id='defPics' class='collapse item-margin-bottom'>", $collapseCtrl)."%s</section>";
                $curRow = "<div class='row item-margin-bottom'>%s</div>";
            
                $i = 0;
                $j = 1;
                while ($stmt->fetch()) {
                    $img = sprintf("<img src='%s' alt='photo related to deficiency number %s'>", $pathToFile, $DefID);
                    $col = sprintf("<div class='col-md-4 text-center item-margin-bottom'>%s</div>", $img);
                    $marker = $j < $count ? '%s' : '';
                    
                    if ($i < 2) {
                        // if this is not 3rd col in row, append an extra format marker '%s' after col
                        $curRow = sprintf($curRow, $col.$marker);
                        // if this is the last photo in resultset, append row to section
                        if ($j >= $count) {
                            $photoSection = sprintf($photoSection, $curRow);
                        }
                        $i++;
                    }
                    // if this is 3rd col in row append row to section
                    else {
                        // if this is not the last photo is resultset append a str format marker, '%s', to row before appending row to section
                        $curRow = sprintf($curRow, $col).$marker;
                        $photoSection = sprintf($photoSection, $curRow);
                        // reset row string
                        $curRow = "<div class='row item-margin-bottom'>%s</div>";
                        $i = 0;
                    }
                    $j++;
                }
                echo $photoSection;
            }
            $stmt->close();
        }
        
        // if Role has permission level show Update and Clone buttons
        if($Role == 'S' OR $Role == 'A' OR $Role == 'U') {
            echo "
                <div style='display: flex; align-items: center; justify-content: center; hspace:20; margin-bottom:3rem'>
                    <form action='UpdateDef.php' method='POST' onsubmit='' style='text-align:center' />
                        <input type='hidden' name='q' value='".$DefID."'/>
                        <input type='submit' name='submit' value='Update' class='btn btn-primary btn-lg'/>
                    </form>
                    <form action='CloneDef.php' method='POST' onsubmit='' style='text-align:center'>
                        <div style='width:5px; height:auto; display:inline-block'></div>
                        <input type='hidden' name='q' value='".$DefID."'/>
                        <input type='submit' value='Clone' class='btn btn-primary btn-lg'  />
                    </form>
                </div>";
        }
        echo "</main>";
    } else {  
        echo "
        <div='container'>
        <br />
        <br />
        <br />
        <br>Unable to connect<br>
        </div>";
        echo $Def.'<br /><br />';
      exit();  
    } 
    include('fileend.php');
    MySqli_Close($link); 
?>