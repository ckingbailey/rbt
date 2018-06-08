<?php
include('session.php');
include('SQLFunctions.php');
include('html_functions/bootstrapGrid.php');
$link = f_sqlConnect();
$Role = $_SESSION['Role'];
$title = "SVBX - New Deficiency";
if($Role == 'V') {
    header('Location: unauthorised.php');
}
include('filestart.php');

echo "
<header class='container page-header'>
    <h1 class='page-title'>Add New Deficiency</h1>
</header>
<main role='main' class='container main-content'>
    <form action='RecDef.php' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='username' value='{$_SESSION['Username']}' />";
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
                    ],
                    'SystemAffected' => [
                        "label" => "<label for='SystemAffected' class='required'>System Affected</label>",
                        "tagName" => 'select',
                        'element' => "<select name='SystemAffected' id='SystemAffected' class='form-control' required>%s</select>",
                        "type" => '',
                        "name" => 'SystemAffected',
                        "id" => 'SystemAffected',
                        "query" => "SELECT SystemID, System FROM System ORDER BY System",
                    ]
                ],
                [
                    'Location' => [
                        "label" => "<label for='Location' class='required'>General Location</label>",
                        "tagName" => 'select',
                        'element' => "<select name='Location' id='Location' class='form-control' required>%s</select>",
                        "type" => '',
                        "name" => 'Location',
                        "id" => 'Location',
                        "query" => "SELECT LocationID, LocationName FROM Location ORDER BY LocationName",
                    ],
                    'SpecLoc' => [
                        "label" => "<label for='SpecLoc' class='required'>Specific Location</label>",
                        "tagName" => "input",
                        "element" => "<input type='text' name='SpecLoc' id='SpecLoc' value='%s' class='form-control' required>",
                        "type" => 'text',
                        "name" => 'SpecLoc',
                        "id" => 'SpecLoc',
                        "query" => null,
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
                    ],
                    'Severity' => [
                        "label" => "<label for='Severity' class='required'>Severity</label>",
                        "tagName" => "select",
                        "element" => "<select name='Severity' id='Severity' class='form-control' required>%s</select>",
                        "type" => null,
                        "name" => 'Severity',
                        "id" => 'Severity',
                        "query" => "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName",
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
                    ],
                    'GroupToResolve' =>[
                        "label" => "<label for='GroupToResolve' class='required'>Group to Resolve</label>",
                        "tagName" => "select",
                        "element" => "<select name='GroupToResolve' id='GroupToResolve' class='form-control' required>%s</select>",
                        "type" => null,
                        "name" => 'GroupToResolve',
                        "id" => 'GroupToResolve',
                        "query" => "SELECT SystemID, System FROM System ORDER BY System",
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
                    ],
                    'contractID' => [
                        'label' => "<label for='contractID' class='required'>Contract</label>",
                        'tagName' => 'select',
                        'element' => "<select name='contractID' id='contractID' class='form-control' required>%s</select>",
                        'type' => null,
                        'name' => 'contractID',
                        'id' => 'contractID',
                        'query' => "SELECT contractID, contract FROM Contract ORDER BY contractID",
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
                    ],
                    'defType' => [
                        'label' => "<label for='defType' class='required'>Deficiency type</label>",
                        'tagName' => "select",
                        'element' => "<select name='defType' id='defType' class='form-control' required>%s</select>",
                        'type' => null,
                        'name' => 'defType',
                        'id' => 'defType',
                        'query' => 'SELECT defTypeID, defTypeName FROM defType',
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
                        "query" => null
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
                    ],
                    'ActionOwner' => [
                        "label" => "<label for='ActionOwner'>Action Owner</label>",
                        "tagName" => "input",
                        "element" => "<input type='text' name='ActionOwner' id='ActionOwner' value='%s' class='form-control'>",
                        "type" => 'text',
                        "name" => 'ActionOwner',
                        "id" => 'ActionOwner',
                        "query" => null,
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
                    ],
                    'CDL_pics' => [
                        'label' => "<label for='CDL_pics'>Upload Photo</label>",
                        'tagName' => 'input',
                        'element' => "<input type='file' accept='image/*' name='CDL_pics' id='CDL_pics' class='form-control form-control-file'>",
                        'type' => 'file',
                        'name' => 'CDL_pics',
                        'id' => 'CDL_pics',
                        'query' => null // this will need a query for photo evidence
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
                        "query" => null
                    ]
                ]
            ];
            
            $closureRows = [
                [
                    'EvidenceType' => [
                        "label" => "<label for='EvidenceType'>Evidence Type</label>",
                        "tagName" => 'select',
                        'element' => "<select name='EvidenceType' id='EvidenceType' class='form-control'>%s</select>",
                        "type" => '',
                        "name" => 'EvidenceType',
                        "id" => 'EvidenceType',
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
                        'value' => $evidenceLink
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
                        "query" => null
                    ]
                ]
            ];
            
            echo "<h5 class='grey-bg pad'>Required Information</h5>";
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
                $options = count($gridRow) > 1 ? ['inline' => true] : ['colWd' => 6];
                print returnRow($gridRow, $options);
            }
            echo "</div>";
            
            echo "
                <h5 class='grey-bg pad'>
                    <a data-toggle='collapse' href='#closureInfo' role='button' aria-expanded='false' aria-controls='closureInfo' class='collapsed'>Closure Information<i class='typcn typcn-arrow-sorted-down'></i></a>
                </h5>
                <div id='closureInfo' class='collapse item-margin-bottom'>";
            foreach ($closureRows as $gridRow) {
                $options = count($gridRow) > 1 ? ['inline' => true] : ['colWd' => 6];
                print returnRow($gridRow, $options);
            }
            echo "</div>";
            
    echo "
        <div class='center-content'>
            <button type='submit' value='submit' class='btn btn-primary btn-lg'>Submit</button>
            <button type='reset' value='reset' class='btn btn-primary btn-lg'>Reset</button>
        </div>
    </form>
</main>";

$link->close();
include('fileend.php');
?>
