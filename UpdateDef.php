<?php
include('session.php');
$title = "SVBX - Update Deficiency";
$role = $_SESSION['Role'];
include('html_functions/bootstrapGrid.php');
include('filestart.php');
$defID = $_GET['defID'];
$defSql = file_get_contents("UpdateDef.sql").$defID;

$link = f_sqlConnect();

error_reporting(E_ALL);  
ini_set("display_errors", 1);

if($stmt = $link->prepare($defSql)) {
    if ($stmt->execute()) {
        if ($stmt->bind_result(
            $oldID, 
            $locationName, 
            $specLoc, 
            $severityName, 
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
            $defType)) {
            echo "
                <header class='container page-header'>
                    <h1 class='page-title'>Update Deficiency ".$defID."</h1>
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
                        'LocationName' => [
                            "label" => "<label for='LocationName' class='required'>General Location</label>",
                            "tagName" => 'select',
                            'element' => "<select name='LocationName' id='LocationName' class='form-control' required>%s</select>",
                            "type" => '',
                            "name" => 'LocationName',
                            "id" => 'LocationName',
                            "query" => "SELECT LocationID, LocationName FROM Location ORDER BY LocationName",
                            'value' => $locationName
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
                        'SeverityName' => [
                            "label" => "<label for='SeverityName' class='required'>Severity</label>",
                            "tagName" => "select",
                            "element" => "<select name='SeverityName' id='SeverityName' class='form-control' required>%s</select>",
                            "type" => null,
                            "name" => 'SeverityName',
                            "id" => 'SeverityName',
                            "query" => "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName",
                            'value' => $severityName
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
                    <form action='UpdateDefCommit.php' method='POST' enctype='multipart/form-data' onsubmit='' class='item-margin-bottom'>
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
                // echo returnRow([$formCtrls['Description']], ['colWd' => 6]);
                
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
                    // echo returnRow([$formCtrls['comments']], ['colWd' => 6]);
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
                    // echo returnRow([$formCtrls['ClosureComments']], ['colWd' => 6]);
                echo "
                    </div>
                    <div class='row item-margin-bottom'>
                        <div class='col-12 center-content'>
                            <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
                            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
                        </div>
                    </div>
                </form>";
                if ($role === 'S') {
                    echo "
                        <form action='DeleteDef.php' method='POST' onsubmit=''>
                            <div class='row'>
                                <div class='col-12 center-content'>
                                    <button class='btn btn-danger btn-lg' type='submit' name='q' value='$defID'
                                        onclick='return confirm(`ARE YOU SURE? Deficiencies should not be deleted, your deletion will be logged.`)'>delete</button>
                                </div>
                            </div>
                        </form>";
                }
            }
        } else {
            echo "
            <div class='container page-header'>
            <h5>There was a problem with the bind</h5>";
            echo "<pre>";
            echo $stmt->error;
            echo "</pre>";
            echo "<p>$defSql</p>";
            echo "</div>";
            exit;
        }
    } else {
        echo "
            <div class='container page-header'>
            <h5>There was a problem with the request</h5>";
        echo "<pre>";
        echo $stmt->error;
        echo "</pre>";
        echo "<p>$defSql</p>";
        echo "</div>";
        exit;
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