<?php
include('session.php');
include('html_functions/bootstrapGrid.php');
include('html_functions/htmlForms.php');
include('filestart.php'); 

$title = "SVBX - Update Deficiency";
$link = f_sqlConnect();
$defID = $_POST['defID'];
$defSql = file_get_contents("UpdateDef.sql").$defID;
error_reporting(E_ALL);  
ini_set("display_errors", 1);
// $sql1 = "SELECT LocationID, LocationName FROM Location ORDER BY LocationName";
// $list1 = mysqli_query($link,$sql1);
// $sql2 = "SELECT SystemID, System FROM System ORDER BY System";
// $list2 = mysqli_query($link,$sql2);
// $sql3 = "SELECT StatusID, Status FROM Status WHERE StatusID <> 3 ORDER BY StatusID";
// $list3 = mysqli_query($link,$sql3);
// $sql4 = "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName";
// $list4 = mysqli_query($link,$sql4);
// $sql5 = "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType";
// $list5 = mysqli_query($link,$sql5);
// $sql6 = "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY RequiredBy";
// $list6 = mysqli_query($link,$sql6);
// $sql7 = "SELECT RepoID, Repo FROM Repo ORDER BY Repo";
// $list7 = mysqli_query($link,$sql7);
// $sql8 = "SELECT YesNoID, YesNo FROM YesNo ORDER BY YesNo";
// $list8 = mysqli_query($link,$sql8);

if($stmt = $link->prepare($defSql)) { 
    $stmt->execute();  
    $stmt->bind_result(
        $oldID, 
        $location, 
        $specLoc, 
        $severity, 
        $Description,
        $spec,
        $DateCreated, 
        $status,
        $identifiedBy,
        $systemAffected, 
        $groupToResolve,
        $actionOwner,
        $eviType, 
        $evidenceLink, 
        $DateClosed, 
        $LastUpdated, 
        $Updated_by, 
        $comments, 
        $requiredBy,
        $contract,
        $repo, 
        $ClosureComments,
        $dueDate,
        $safetyCert,
        $defType);
    echo "
    <header class='container page-header'>
        <h1 class='page-title'>Clone Deficiency ".$defID."</h1>
    </header>
    <main class='container main-content'>";

    while ($stmt->fetch()) {
        $requiredRows = [
            [
                'SafetyCert' => [
                    "label" => "<label for='SafetyCert' class='required'>Safety Certifiable</label>",
                    "tagName" => 'select',
                    'element' => "<select name='SafetyCert' id='SafetyCert' class='form-control' required>%s</select>",
                    "type" => '',
                    "name" => 'SafetyCert',
                    "id" => 'SafetyCert',
                    "query" => "SELECT YesNoID, YesNo FROM YesNo ORDER BY YesNo",
                    'value' => $safetyCert
                ],
                'SystemAffected' => [
                    "label" => "<label for='SystemAffected' class='required'>System Affected</label>",
                    "tagName" => 'select',
                    'element' => "<select name='SystemAffected' id='SystemAffected' class='form-control' required>%s</select>",
                    "type" => '',
                    "name" => 'SystemAffected',
                    "id" => 'SystemAffected',
                    "query" => "SELECT SystemID, System FROM System ORDER BY System",
                    'value' => $systemAffected
                ]
            ],
            [
                'Location' => [
                    "label" => "<label for='Location' class='required'>General Location</label>",
                    "tagName" => 'select',
                    'element' => "<select name='Location' id='LocationName' class='form-control' required>%s</select>",
                    "type" => '',
                    "name" => 'Location',
                    "id" => 'Location',
                    "query" => "SELECT LocationID, LocationName FROM Location ORDER BY LocationName",
                    'value' => $location
                ],
                'SpecLoc' => [
                    "label" => "<label for='SpecLoc' class='required'>Specific Location</label>",
                    "tagName" => "input",
                    "element" => "<input type='text' name='SpecLoc' id='SpecLoc' value='%s' class='form-control' required>",
                    "type" => 'text',
                    "name" => 'SpecLoc',
                    "id" => 'SpecLoc',
                    "query" => null,
                    'value' => $specLoc
                ]
            ],
            [
                'Status' => [
                    "label" => "<label for='Status' class='required'>Status</label>",
                    "tagName" => "select",
                    "element" => "<select name='Status' id='Status' class='form-control' required>%s</select>",
                    "type" => null,
                    "name" => 'Status',
                    "id" => 'Status',
                    "query" => "SELECT StatusID, Status FROM Status WHERE StatusID <> 3 ORDER BY StatusID",
                    'value' => $status
                ],
                'Severity' => [
                    "label" => "<label for='Severity' class='required'>Severity</label>",
                    "tagName" => "select",
                    "element" => "<select name='Severity' id='Severity' class='form-control' required>%s</select>",
                    "type" => null,
                    "name" => 'Severity',
                    "id" => 'Severity',
                    "query" => "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName",
                    'value' => $severity
                ]
            ],
            [
                'DueDate' => [
                    "label" => "<label for='DueDate' class='required'>To be resolved by</label>",
                    "tagName" => "input",
                    "element" => "<input type='date' name='DueDate' id='DueDate' value='%s' class='form-control' required>",
                    "type" => 'date',
                    "name" => 'DueDate',
                    "id" => 'DueDate',
                    "query" => null,
                    'value' => $dueDate
                ],
                'GroupToResolve' =>[
                    "label" => "<label for='GroupToResolve' class='required'>Group to Resolve</label>",
                    "tagName" => "select",
                    "element" => "<select name='GroupToResolve' id='GroupToResolve' class='form-control' required>%s</select>",
                    "type" => null,
                    "name" => 'GroupToResolve',
                    "id" => 'GroupToResolve',
                    "query" => "SELECT SystemID, System FROM System ORDER BY System",
                    'value' => $groupToResolve
                ]
            ],
            [
                'RequiredBy' => [
                    "label" => "<label for='RequiredBy' class='required'>Required for</label>",
                    "tagName" => "select",
                    "element" => "<select name='RequiredBy' id='RequiredBy' class='form-control' required>%s</select>",
                    "type" => null,
                    "name" => 'RequiredBy',
                    "id" => 'RequiredBy',
                    "query" => "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY RequiredBy",
                    'value' => $requiredBy
                ],
                'contract' => [
                    'label' => "<label for='contract' class='required'>Contract</label>",
                    'tagName' => 'select',
                    'element' => "<select name='contractID' id='contractID' class='form-control' required>%s</select>",
                    'type' => null,
                    'name' => 'contractID',
                    'id' => 'contractID',
                    'query' => "SELECT contractID, contract FROM Contract ORDER BY contractID",
                    'value' => $contract
                ]
            ],
            [
                'IdentifiedBy' => [
                    "label" => "<label for='IdentifiedBy' class='required'>Identified By</label>",
                    "tagName" => "input",
                    "element" => "<input type='text' name='IdentifiedBy' id='IdentifiedBy' class='form-control' value='%s' required>",
                    "type" => 'text',
                    "name" => 'IdentifiedBy',
                    "id" => 'IdentifiedBy',
                    "query" => null,
                    'value' => stripcslashes($identifiedBy)
                ],
                'defType' => [
                    'label' => "<label for='defType' class='required'>Deficiency type</label>",
                    'tagName' => "select",
                    'element' => "<select name='defType' id='defType' class='form-control' required>%s</select>",
                    'type' => null,
                    'name' => 'defType',
                    'id' => 'defType',
                    'query' => 'SELECT defTypeID, defTypeName FROM defType',
                    'value' => $defType
                ]
            ],
            [
                'Description' => [
                    "label" => "<label for='Description' class='required'>Deficiency Description</label>",
                    "tagName" => "textarea",
                    "element" => "<textarea name='Description' id='Description' class='form-control' maxlength='1000' required>%s</textarea>",
                    "type" => null,
                    "name" => 'Description',
                    "id" => 'Description',
                    "query" => null,
                    'value' => stripcslashes($Description)
                ]
            ]
        ];
        
        $optionalRows = [
            [
                'Spec' => [
                    "label" => "<label for='Spec'>Spec or Code</label>",
                    "tagName" => "input",
                    "element" => "<input type='text' name='Spec' id='Spec' value='%s' class='form-control'>",
                    "type" => 'text',
                    "name" => 'Spec',
                    "id" => 'Spec',
                    "query" => null,
                    'value' => stripcslashes($spec)
                ],
                'ActionOwner' => [
                    "label" => "<label for='ActionOwner'>Action Owner</label>",
                    "tagName" => "input",
                    "element" => "<input type='text' name='ActionOwner' id='ActionOwner' value='%s' class='form-control'>",
                    "type" => 'text',
                    "name" => 'ActionOwner',
                    "id" => 'ActionOwner',
                    "query" => null,
                    'value' => stripcslashes($actionOwner)
                ]
            ],
            [
                'OldID' => [
                    "label" => "<label for='OldID'>Old Id</label>",
                    "tagName" => "input",
                    "element" => "<input type='text' name='OldID' id='OldID' value='%s' class='form-control'>",
                    "type" => 'text',
                    "name" => 'OldID',
                    "id" => 'OldID',
                    "query" => null,
                    'value' => stripcslashes($oldID)
                ],
                'CDL_pics' => [
                    'label' => "<label for='CDL_pics'>Upload Photo</label>",
                    'tagName' => 'input',
                    'element' => "<input type='file' accept='image/*' name='CDL_pics' id='CDL_pics' class='form-control form-control-file'>",
                    'type' => 'file',
                    'name' => 'CDL_pics',
                    'id' => 'CDL_pics',
                    'query' => null
                ]
            ],
            [
                'comments' => [
                    "label" => "<label for='comments'>More Information</label>",
                    "tagName" => "textarea",
                    "element" => "<textarea name='comments' id='comments' class='form-control' maxlength='1000'>%s</textarea>",
                    "type" => null,
                    "name" => 'comments',
                    "id" => 'comments',
                    "query" => null,
                    'value' => stripcslashes($comments)
                ]
            ]
        ];
        
        $closureRows = [
            [
                'EviType' => [
                    "label" => "<label for='EviType'>Evidence Type</label>",
                    "tagName" => 'select',
                    'element' => "<select name='EviType' id='EviType' class='form-control'>%s</select>",
                    "type" => '',
                    "name" => 'EviType',
                    "id" => 'EviType',
                    "query" => "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType",
                    'value' => $eviType
                ],
                'Repo' => [
                    'label' => "<label for='Repo'>Evidence Repository</label>",
                    'tagName' => 'select',
                    'element' => "<select name='Repo' id='Repo' class='form-control'>%s</select>",
                    'type' => '',
                    'name' => 'Repo',
                    'id' => 'Repo',
                    'query' => "SELECT RepoID, Repo FROM Repo ORDER BY Repo",
                    'value' => $repo
                ],
                'EvidenceLink' => [
                    'label' => "<label for='EvidenceLink'>Repository Number</label>",
                    'tagName' => "input",
                    'element' => "<input type='text' name='EvidenceLink' id='EvidenceLink' class='form-control' value='%s'>",
                    'type' => 'text',
                    'name' => 'EvidenceLink',
                    'id' => 'EvidenceLink',
                    'query' => null,
                    'value' => stripcslashes($evidenceLink)
                ]
            ],
            [
                'ClosureComments' => [
                    "label" => "<label for='ClosureComments'>Closure Comments</label>",
                    "tagName" => "textarea",
                    "element" => "<textarea name='ClosureComments' id='ClosureComments' class='form-control' maxlength='1000'>%s</textarea>",
                    "type" => null,
                    "name" => 'ClosureComments',
                    "id" => 'ClosureComments',
                    "query" => null,
                    'value' => stripcslashes($ClosureComments)
                ]
            ]
        ];

        echo "
            <form action='RecDef.php' method='POST' enctype='multipart/form-data' onsubmit='' class='item-margin-bottom'>
                <input type='hidden' name='DefID' value='$defID'>
                <div class='row'>
                    <div class='col-12'>
                        <h4 class='pad grey-bg'>Deficiency No. $defID</h4>
                    </div>
                </div>";
        foreach ($requiredRows as $gridRow) {
            $options = [ 'required' => true ];
            if (count($gridRow) > 1) $options['inline'] = true;
            else $options['colWd'] = 6;
            print returnRow($gridRow, $options);
        }
        echo "
            <h5 class='grey-bg pad'>
                <a data-toggle='collapse' href='#optionalInfo' role='button' aria-expanded='false' aria-controls='optionalInfo' class='collapsed'>Optional Information<i class='typcn typcn-arrow-sorted-down'></i></a>
            </h5>
            <div id='optionalInfo' class='collapse item-margin-bottom'>";
        foreach ($optionalRows as $gridRow) {
            $options = [ 'required' => true ];
            if (count($gridRow) > 1) $options['inline'] = true;
            else $options['colWd'] = 6;
            print returnRow($gridRow, $options);
        }
            echo "<p class='text-center pad-less bg-yellow'>Photos uploaded from your phone may not preserve rotation information. We are working on a fix for this.</p>";
        echo "</div>";
        
        echo "
            <h5 class='grey-bg pad'>
                <a data-toggle='collapse' href='#closureInfo' role='button' aria-expanded='false' aria-controls='closureInfo' class='collapsed'>Closure Information<i class='typcn typcn-arrow-sorted-down'></i></a>
            </h5>
            <div id='closureInfo' class='collapse item-margin-bottom'>";
        foreach ($closureRows as $gridRow) {
            $options = [ 'required' => true ];
            if (count($gridRow) > 1) $options['inline'] = true;
            else $options['colWd'] = 6;
            print returnRow($gridRow, $options);
        }
        echo "
            </div>
            <div class='row item-margin-bottom'>
                <div class='col-12 center-content'>
                    <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
                    <input type='reset' value='reset' class='btn btn-primary btn-lg' />
                </div>
            </div>
        </form>";
    // echo "
    //     <header class='container page-header'>
    //         <h1 class='page-title'>Clone Deficiency ".$q."</h1>
    //     </header>
    //     <main class='container main-content'> 
    //     <form action='RecDef.php' method='POST' onsubmit='' />
    //         <table class='table svbx-table'>
    //             <tr class='vdtr'>
    //             <th colspan='4' height='50' class='vdth'><p>
    //                     Clone Deficiency</p></th>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <th colspan='4' class='vdth'><p>Required Information</p></th>
    //             </tr>
    //             <td class='vdtd'>
    //                     <p>Safety Certifiable:</p>
    //                 </td>
    //             <td class='vdtda'><select name='SafetyCert' value='".$safetyCert."' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list8) || is_object($list8)) {
    //                     foreach($list8 as $row) {
    //                         echo "<option value='$row[YesNoID]'";
    //                             if($row['YesNoID'] == $safetyCert) {
    //                                 echo " selected>$row[YesNo]</option>";
    //                                 } else { echo ">$row[YesNo]</option>";
    //                             }
    //                     }
    //                     }
    //                 echo "
    //                 </td>
    //                 <td class='vdtdh'><p>System Affected:</p></td>
    //                 <td class='vdtda'><select name='SystemAffected' value='".$SystemAffected."' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list2) || is_object($list2)) {
    //                     foreach($list2 as $row) {
    //                         echo "<option value='$row[SystemID]'";
    //                             if($row['SystemID'] == $SystemAffected) {
    //                                 echo " selected>$row[System]</option>";
    //                                 } else { echo ">$row[System]</option>";
    //                             }
    //                     }
    //                     }
    // echo "      </td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'><p>General Location:</p></td>
    //                 <td class='vdtda'><select name='Location' value='' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list1) || is_object($list1)) {
    //                     foreach($list1 as $row) {
    //                         echo "<option value='$row[LocationID]'>$row[LocationName]</option>";
    //                             }
    //                     }
    // echo "          </td>
    //                 <td class='vdtdh'><p>Specific Location:</p></td>
    //                 <td class='vdtda'><p><input type='text' name='SpecLoc' value='".$SpecLoc."' max='55' id='defdd'/></p></td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'><p>Status:</p></td>
    //                 <td class='vdtda'><select name='Status' value='".$Status."' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list3) || is_object($list3)) {
    //                     foreach($list3 as $row) {
    //                         echo "<option value='$row[StatusID]'";
    //                             if($row['StatusID'] == $Status) {
    //                                 echo " selected>$row[Status]</option>";
    //                                 } else { echo ">$row[Status]</option>";
    //                             }
    //                     }
    //                     }
    // echo "          </td>
    //                 <td class='vdtdh'><p>Severity:</p></td>
    //                 <td class='vdtda'><select name='Severity' value='".$Severity."' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list4) || is_object($list4)) {
    //                     foreach($list4 as $row) {
    //                         echo "<option value='$row[SeverityID]'";
    //                             if($row['SeverityID'] == $Severity) {
    //                                 echo " selected>$row[SeverityName]</option>";
    //                                 } else { echo ">$row[SeverityName]</option>";
    //                             }
    //                     }
    //                     }
    // echo "      </td>
    //             </tr>
    //             <tr class='vdtr'>    
    //                 <td class='vdtdh'>
    //                     <p>To be resolved by:</p>
    //                 </td>
    //                 <td class='vdtd'>
    //                     <input type='date' name='DueDate' id='defdd' value='$DueDate' required/>
    //                 </td>
    //                 <td class='vdtdh'>
    //                     <p>Required for:</p>
    //                 </td>
    //                 <td class='vdtda'><select name='RequiredBy' value='".$RequiredBy."' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list6) || is_object($list6)) {
    //                     foreach($list6 as $row) {
    //                         echo "<option value='$row[ReqByID]'";
    //                             if($row['ReqByID'] == $RequiredBy) {
    //                                 echo " selected>$row[RequiredBy]</option>";
    //                                 } else { echo ">$row[RequiredBy]</option>";
    //                             }
    //                     }
    //                     }
    // echo "
    //                 </td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'><p>Group to Resolve:</p></td>
    //                 <td class='vdtda'><select name='GroupToResolve' value='".$GroupToResolve."' id='defdd'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list2) || is_object($list2)) {
    //                     foreach($list2 as $row) {
    //                         echo "<option value='$row[SystemID]'";
    //                             if($row['SystemID'] == $GroupToResolve) {
    //                                 echo " selected>$row[System]</option>";
    //                                 } else { echo ">$row[System]</option>";
    //                             }
    //                     }
    //                     }
    // echo "          </td>
    //                 <td class='vdtdh'><p>Identified By:</p></td>
    //                 <td class='vdtda'><input type='text' name='IdentifiedBy' value='".$IdentifiedBy."' max='24' id='defdd'/></td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td colspan='4' style='text-align:center' class='vdtdh'><p>Deficiency Description</p></th>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td Colspan=4  style='text-align:center'><textarea type='message' rows='5' cols='99%' name='Description' max='1000'>$Description</textarea></td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <th colspan='4' class='vdth'><p>Optional Information</p></th>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'><p>Spec or Code:</p></td>
    //                 <td class='vdtda' colspan='3'><input type='text' name='Spec' value='".$Spec."' max='24'/></td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'><p>Action Owner:</p></td>
    //                 <td class='vdtda'><input type='text' name='ActionOwner' value='".$ActionOwner."' max='24'/></td>
    //                 <td class='vdtdh'><p>Old Id:</p></td>
    //                 <td class='vdtda'><input type='text' name='OldID' value='".$OldID."' max='24'/></td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td colspan='4' style='text-align:center' class='vdtdh'>
    //                     <p>More Information</p>
    //                 </td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td Colspan=4 class='vdtda' style='text-align:center'>
    //                     <textarea type='message'  rows='5' cols='99%' name='comments' max='1000'>$Comments</textarea>
    //                 </td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <th colspan='4'th class='vdth'><p>Closure Information</p></th>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'><p>Evidence Type:</p></td>
    //                 <td class='vdtda' colspan='3'>
    //                 <select name='EvidenceType' value='".$EvidenceType."'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list5) || is_object($list5)) {
    //                     foreach($list5 as $row) {
    //                         echo "<option value='$row[EviTypeID]'";
    //                             if($row['EviTypeID'] == $EvidenceType) {
    //                                 echo " selected>$row[EviType]</option>";
    //                                 } else { echo ">$row[EviType]</option>";
    //                             }
    //                     }
    //                     }
    // echo "          </tr>
    //             <tr class='vdtr'>
    //                 <td class='vdtdh'>
    //                     <p>Evidence Repository:</p>
    //                 </td>
    //                 <td class='vdtda'>
    //                 <select name='Repo' value='".$Repo."'></option>
    //                     <option value=''></option>";
    //                     if(is_array($list7) || is_object($list7)) {
    //                     foreach($list7 as $row) {
    //                         echo "<option value='$row[RepoID]'";
    //                             if($row['RepoID'] == $Repo) {
    //                                 echo " selected>$row[Repo]</option>";
    //                                 } else { echo ">$row[Repo]</option>";
    //                             }
    //                     }
    //                     }
    // echo "                </td>
    //                 <td class='vdtdh'>
    //                     <p>Repository Number</p>
    //                 </td>
    //                 <td class='vdtda'>
    //                     <input type='text' name='EvidenceLink' max='255' value='$EvidenceLink' id='defdd'/>
    //                 </td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td colspan='4' style='text-align:center'  class='vdtdh'>
    //                     <p>Closure Comments</p>
    //                 </td>
    //             </tr>
    //             <tr class='vdtr'>
    //                 <td Colspan=4 class='vdtda' style='text-align:center'>
    //                     <textarea type='message'  rows='5' cols='99%' name='ClosureComments' max='1000'>$ClosureComments</textarea>
    //                 </td>
    //             </tr>
    //         </table>
    //         <br />
    //         <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
    //         <input type='reset' value='reset' class='btn btn-primary btn-lg' /><br /><br />
    //         </form>
    //         </div></main>
    //         ";
    }
    echo "</main>";
} else {  
    echo "<div class='container page-header'>";
    echo "<pre>";
    echo $link->error;
    echo "</pre>";
    echo "<p>$defSql</p>";
    echo "</div>";
    exit;
} 
$link->close();             
include('fileend.php');
?>