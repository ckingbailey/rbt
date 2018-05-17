<?php
include('session.php');
session_start();
$title = "SVBX - Update Deficiency";
$role = $_SESSION['Role'];
include('filestart.php'); 

$link = f_sqlConnect();
$link2 = f_sqlConnect();
$q = $_POST['q'];
$Def = file_get_contents("UpdateDef.sql").$q;
error_reporting(E_ALL);  
ini_set("display_errors", 1);

function returnSelectInput($cnxn, $data) {
    $selectEl = "<{$data['tagName']} name='{$data['name']}' id='{$data['id']}' class='form-control'>";
    $options = "<option value=''></option>";
    // if val @ [query] is a string, use it query db
    // if val @ [query] is a sql query result, use it
    $result = is_string($data['query']) ? $cnxn->query($data['query']) : $data['query'];
    if ($result) {
        while ($row = $result->fetch_row()) {
            $selected = $row[0] == $data['value'] ? ' selected' : ' data-notSelected';
            $options .= "<option value='{$row[0]}'{$selected}>{$row[1]}</option>";
        }
    } elseif ($cnxn->error) {
        $options .= "<option selected>{$cnxn->error}</option>";
    } else $options .= "<option selected>There was a problem with the query</option>";
    $selectEl .= $options;
    $selectEl .= "</select>";
    $result->close();
    return $selectEl;
}

function returnTextInput($cnxn, $data) {
    $inputEl = sprintf($data['element'], $data['value']);
    return $inputEl;
}

function returnDateInput($cnxn, $data) {
    $dateEl = sprintf($data['element'], $data['value']);
    return $dateEl;
}

function returnFileInput($cnxn, $data) {
    return $data['element'];
}

function returnTextarea($cnxn, $data) {
    $textarea = sprintf($data['element'], $data['value']);
    return $textarea;
}

function returnFormCtrl($cnxn, $formCtrl) {
    if ($formCtrl['tagName'] === 'select') {
        return returnSelectInput($cnxn, $formCtrl);
    } elseif ($formCtrl['tagName'] === 'input') {
        if ($formCtrl['type'] === 'text') {
            return returnTextInput($cnxn, $formCtrl);
        } elseif ($formCtrl['type'] === 'date') {
            return returnDateInput($cnxn, $formCtrl);
        } elseif ($formCtrl['type'] === 'file') {
            // $col .= "<h3 style='color: var(--purple)'>type === file</h3>";
            return returnFileInput($cnxn, $formCtrl);
        }
    } elseif ($formCtrl['tagName'] === 'textarea') {
        return returnTextarea($cnxn, $formCtrl);
    }
}

function returnCol($cnxn, $element, $wd, $options = []) {
    if (isset($options['offset'])) {
        $wd .= " offset-md-{$options['offset']}";
    }

    $colStr = "<div class='col-md-$wd'>%s</div>";

    if (isset($options['inline'])) {
        $subCol = "<div class='col-sm-6'>%s</div>";
        $labelCol = sprintf($subCol, $element['label']);
        $ctrlCol = sprintf($subCol, returnFormCtrl($cnxn, $element));
        $subRow = sprintf("<div class='row'>%s%s</div>", $labelCol, $ctrlCol);
        $col = sprintf($colStr, $subRow);
    } else {
        $col = sprintf($colStr, $element['label'].returnFormCtrl($cnxn, $element));
    }
    return $col;
}

function returnRow($cnxn, $elements, $options = []) {
    $elRow = "<div class='row item-margin-bottom'>";
    $numEls = count($elements);
    // if number of elements don't divide evenly by 12 substract out the remainder
    // this number will be added to the last col
    $extraCols = 12 % $numEls;
    $colWd = 12 / ($numEls - $extraCols);
    // if row is singular and has a specific wd, pass it and its wd to returnCol without looping
    if (count($elements) === 1 && isset($options['colWd'])) {
        $offset = floor((12 - $options['colWd'])/2);
        $elRow .= returnCol($cnxn, $elements[0], $options['colWd'], ['offset' => $offset]);
    } else foreach ($elements as $el) {
        $elRow .= returnCol($cnxn, $el, $colWd, $options);
    }
    $elRow .= "</div>";
    return $elRow;
}

// this fcn takes a collection of arrays of string names of form control elements,
// looks up those form controls by name in a collection that describes their properties
// and passes the named form control data to a fcn to that renders each subarray as a row
function printRowGroup($cnxn, $group, $elementCollection, $options = []) {
    foreach ($group as $row) {
        // iterate over each row replacing string at cur index with content at key = string in formCtrls
        foreach ($row as $i => $str) {
            $row[$i] = $elementCollection[$str];
        }
        echo returnRow($cnxn, $row, $options);
    }
}

// form control data
$formCtrls = [
    'SafetyCert' => [
        "label" => "<label for='SafetyCert'>Safety Certifiable</label>",
        "tagName" => 'select',
        "type" => '',
        "name" => 'SafetyCert',
        "id" => 'SafetyCert',
        "query" => "SELECT YesNoID, YesNo FROM YesNo ORDER BY YesNo"
    ],
    'SystemAffected' => [
        "label" => "<label for='SystemAffected'>System Affected</label>",
        "tagName" => 'select',
        "type" => '',
        "name" => 'SystemAffected',
        "id" => 'SystemAffected',
        "query" => "SELECT SystemID, System FROM System ORDER BY System"
    ],
    'LocationName' => [
        "label" => "<label for='LocationName'>General Location</label>",
        "tagName" => 'select',
        "type" => '',
        "name" => 'LocationName',
        "id" => 'LocationName',
        "query" => "SELECT LocationID, LocationName FROM Location ORDER BY LocationName"
    ],
    'SpecLoc' => [
        "label" => "<label for='SpecLoc'>Specific Location</label>",
        "tagName" => "input",
        "element" => "<input type='text' name='SpecLoc' id='SpecLoc' value='%s' class='form-control'>",
        "type" => 'text',
        "name" => 'SpecLoc',
        "id" => 'SpecLoc',
        "query" => null
    ],
    'Status' => [
        "label" => "<label for='Status'>Status</label>",
        "tagName" => "select",
        "element" => "<select name='SpecLoc' id='SpecLoc' class='form-control'>",
        "type" => null,
        "name" => 'Status',
        "id" => 'Status',
        "query" => "SELECT StatusID, Status FROM Status WHERE StatusID <> 3 ORDER BY StatusID"
    ],
    'SeverityName' => [
        "label" => "<label for='SeverityName'>Severity</label>",
        "tagName" => "select",
        "element" => "<select name='SeverityName' id='SeverityName' class='form-control'>",
        "type" => null,
        "name" => 'SeverityName',
        "id" => 'SeverityName',
        "query" => "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName"
    ],
    'DueDate' => [
        "label" => "<label for='DueDate'>To be resolved by</label>",
        "tagName" => "input",
        "element" => "<input type='date' name='DueDate' id='DueDate' value='%s' class='form-control'>",
        "type" => 'date',
        "name" => 'DueDate',
        "id" => 'DueDate',
        "query" => null
    ],
    'RequiredBy' => [
        "label" => "<label for='RequiredBy'>Required for</label>",
        "tagName" => "select",
        "element" => "<select name='RequiredBy' id='RequiredBy' class='form-control'>",
        "type" => null,
        "name" => 'RequiredBy',
        "id" => 'RequiredBy',
        "query" => "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY RequiredBy"
    ],
    'GroupToResolve' =>[
        "label" => "<label for='GroupToResolve'>Group to Resolve</label>",
        "tagName" => "select",
        "element" => "<select name='GroupToResolve' id='GroupToResolve' class='form-control'>",
        "type" => null,
        "name" => 'GroupToResolve',
        "id" => 'GroupToResolve',
        "query" => "SELECT SystemID, System FROM System ORDER BY System"
    ],
    'IdentifiedBy' => [
        "label" => "<label for='IdentifiedBy'>Identified By</label>",
        "tagName" => "input",
        "element" => "<input type='text' name='IdentifiedBy' id='IdentifiedBy' class='form-control' value='%s'>",
        "type" => 'text',
        "name" => 'IdentifiedBy',
        "id" => 'IdentifiedBy',
        "query" => null
    ],
    'Description' => [
        "label" => "<label for='Description'>Deficiency Description</label>",
        "tagName" => "textarea",
        "element" => "<textarea name='Description' id='Description' class='form-control' maxlength='1000'>%s</textarea>",
        "type" => null,
        "name" => 'Description',
        "id" => 'Description',
        "query" => null
    ],
    'Spec' => [
        "label" => "<label for='Spec'>Spec or Code</label>",
        "tagName" => "input",
        "element" => "<input type='text' name='Spec' id='Spec' value='%s' class='form-control'>",
        "type" => 'text',
        "name" => 'Spec',
        "id" => 'Spec',
        "query" => null
    ],
    'ActionOwner' => [
        "label" => "<label for='ActionOwner'>Action Owner</label>",
        "tagName" => "input",
        "element" => "<input type='text' name='ActionOwner' id='ActionOwner' value='%s' class='form-control'>",
        "type" => 'text',
        "name" => 'ActionOwner',
        "id" => 'ActionOwner',
        "query" => null
    ],
    'OldID' => [
        "label" => "<label for='OldID'>Old Id</label>",
        "tagName" => "input",
        "element" => "<input type='text' name='OldID' id='OldID' value='%s' class='form-control'>",
        "type" => 'text',
        "name" => 'OldID',
        "id" => 'OldID',
        "query" => null
    ],
    'CDL_pics' => [
        'label' => "<label for='CDL_pics'>Upload Photo</label>",
        'tagName' => 'input',
        'element' => "<input type='file' accept='image/*' name='CDL_pics' id='CDL_pics' class='form-control form-control-file'>",
        'type' => 'file',
        'name' => 'CDL_pics',
        'id' => 'CDL_pics',
        'query' => null // this will need a query for photo evidence
    ],
    'comments' => [
        "label" => "<label for='comments'>More Information</label>",
        "tagName" => "textarea",
        "element" => "<textarea name='comments' id='comments' class='form-control' maxlength='1000'>%s</textarea>",
        "type" => null,
        "name" => 'comments',
        "id" => 'comments',
        "query" => null
    ],
    'EviType' => [
        "label" => "<label for='EviType'>Evidence Type</label>",
        "tagName" => 'select',
        'element' => "<select name='EviType' id='EviType' class='form-control'>%s</select>",
        "type" => '',
        "name" => 'EviType',
        "id" => 'EviType',
        "query" => "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType"
    ],
    'Repo' => [
        'label' => "<label for='Repo'>Evidence Repository</label>",
        'tagName' => 'select',
        'element' => "<select name='Repo' id='Repo' class='form-control'>%s</select>",
        'type' => '',
        'name' => 'Repo',
        'id' => 'Repo',
        'query' => "SELECT RepoID, Repo FROM Repo ORDER BY Repo"
    ],
    'EvidenceLink' => [
        'label' => "<label for='EvidenceLink'>Repository Number</label>",
        'tagName' => "input",
        'element' => "<input type='text' name='EvidenceLink' id='EvidenceLink' class='form-control'>",
        'type' => 'text',
        'name' => 'EvidenceLink',
        'id' => 'EvidenceLink',
        'query' => null
    ],
    'ClosureComments' => [
        "label" => "<label for='ClosureComments'>Closure Comments</label>",
        "tagName" => "textarea",
        "element" => "<textarea name='ClosureComments' id='ClosureComments' class='form-control' maxlength='1000'>%s</textarea>",
        "type" => null,
        "name" => 'ClosureComments',
        "id" => 'ClosureComments',
        "query" => null
    ]
];

// row collections referencing form control data above
$requiredRows = [
    [ 'SafetyCert', 'SystemAffected' ],
    [ 'LocationName', 'SpecLoc' ],
    [ 'Status', 'SeverityName' ],
    [ 'DueDate', 'RequiredBy' ],
    [ 'GroupToResolve', 'IdentifiedBy' ]
];

$optionalRows = [
    [ 'Spec', 'ActionOwner' ],
    [ 'OldID', 'CDL_pics' ]
];

$closureRows = [
    [ 'EviType', 'Repo', 'EvidenceLink' ]
];

    echo "
        <header class='container page-header'>
            <h1 class='page-title'>Update Deficiency ".$q."</h1>
        </header>
        <main class='container main-content'>";

    if($stmt = $link->prepare($Def)) {
        $stmt->execute();
        $stmt->bind_result(
            $formCtrls['OldID']['value'], 
            $formCtrls['LocationName']['value'], 
            $formCtrls['SpecLoc']['value'], 
            $formCtrls['SeverityName']['value'], 
            $formCtrls['Description']['value'], 
            $formCtrls['Spec']['value'],
            $DateCreated, 
            $formCtrls['Status']['value'],
            $formCtrls['IdentifiedBy']['value'], 
            $formCtrls['SystemAffected']['value'], 
            $formCtrls['GroupToResolve']['value'], 
            $formCtrls['ActionOwner']['value'], 
            $formCtrls['EviType']['value'], 
            $formCtrls['EvidenceLink']['value'], 
            $DateClosed, 
            $LastUpdated, 
            $Updated_by, 
            $formCtrls['comments']['value'], 
            $formCtrls['RequiredBy']['value'], 
            $formCtrls['Repo']['value'], 
            $Pics, 
            $formCtrls['ClosureComments']['value'],
            $formCtrls['DueDate']['value'],
            $formCtrls['SafetyCert']['value']);
                
        while ($stmt->fetch()) {
            echo "
                <form action='UpdateDefCommit.php' method='POST' enctype='multipart/form-data' onsubmit='' class='item-margin-bottom'>
                    <input type='hidden' name='DefID' value='$q'>
                    <div class='row'>
                        <div class='col-12'>
                            <h4 class='pad grey-bg'>Deficiency No. $q</h4>
                        </div>
                    </div>";
                    
            printRowGroup($link2, $requiredRows, $formCtrls, ['inline' => true]);
            echo returnRow($link2, [$formCtrls['Description']], ['colWd' => 6]);
            
            echo "
                <h5 class='grey-bg pad'>
                    <a data-toggle='collapse' href='#optionalInfo' role='button' aria-expanded='false' aria-controls='optionalInfo' class='collapsed'>Optional Information<i class='typcn typcn-arrow-sorted-down'></i></a>
                </h5>
                <div id='optionalInfo' class='collapse item-margin-bottom'>";
                printRowGroup($link2, $optionalRows, $formCtrls, ['inline' => true]);
                echo "<p class='text-center pad-less bg-yellow'>Photos uploaded from your phone may not preserve rotation information. We are working on a fix for this.</p>";
                echo returnRow($link2, [$formCtrls['comments']], ['colWd' => 6]);
            echo "</div>";
            
            echo "
                <h5 class='grey-bg pad'>
                    <a data-toggle='collapse' href='#closureInfo' role='button' aria-expanded='false' aria-controls='closureInfo' class='collapsed'>Closure Information<i class='typcn typcn-arrow-sorted-down'></i></a>
                </h5>
                <div id='closureInfo' class='collapse item-margin-bottom'>";
                printRowGroup($link2, $closureRows, $formCtrls, ['inline' => true]);
                echo returnRow($link2, [$formCtrls['ClosureComments']], ['colWd' => 6]);
            echo "</div>";
            // echo returnRow($link2, array_slice($formCtrls, 15, 3));
            // echo returnRow($link2, array_slice($formCtrls, 18, 1));
    echo "
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
                            <button class='btn btn-danger btn-lg' type='submit' name='q' value='$q'
                                onclick='return confirm(`ARE YOU SURE? Deficiencies should not be deleted, your deletion will be logged.`)'>delete</button>
                        </div>
                    </div>
                </form>";
        }

        echo "</main>";
        }
    } else {  
        echo "<br>Unable to connect<br>";
        exit();  
    }
    $link->close();
    $link2->close();
    include('fileend.php');
?>