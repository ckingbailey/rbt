<?php
include('SQLFunctions.php');
session_start();
include('filestart.php');
$title = "SVBX - Inspector's Daily Report";
$curDateNum = date('Y-m-d');
$reptNum = 0; // generate this based on db

$link = f_sqlConnect();
$userID = $_SESSION['UserID'];
$username = $_SESSION['Username'];
// why do this check if $_SESSION already has $Username(?)
$userQry = 'SELECT firstname, lastname, viewIDR FROM users_enc WHERE UserID = '.$UserID;
$contractQry = 'SELECT ContractID, Contract FROM Contract';
if($result=mysqli_query($link,$userQry)) {
  /*from the sql results, assign the username that returned to the $username variable*/    
  while($row = mysqli_fetch_assoc($result)) {
    $userFullName = "{$row['firstname']} {$row['lastname']}";
    $authorizeUser = intval($row['viewIDR']);
  }
}

$sqlLoc = "SELECT L.LocationName, C.Location FROM CDL C inner join Location L on L.LocationID=C.Location group by Location order by L.LocationName";

if ($authorizeUser !== 1) {
    include 'unauthorised.php';
} else {
echo "
<header class='container page-header'>
    <h1 class='page-title'>Inspector's Daily Report</h1>
</header>
<main class='container main-content'>
    <h6><span class='text-danger'>*</span><span> = required</span></h6>
    <form id='dailyReportForm'>
        <div class='flex-row space-between align-stretch item-margin-bottom'>
            <fieldset id='dayData' class='card half-container'>
                <div class='card-header grey-bg'>
                    <h6 class='flex-row space-between'>
                        <span class='item-margin-right'>Inspector Name</span>
                        <span>{$userFullName}</span>
                    </h6>
                    <input type='hidden' name='userID' value='{$userID}' />
                </div>
                <div class='card-body'>
                    <div class='flex-row no-wrap space-between align-center item-margin-bottom'>
                        <label class='input-label item-margin-right'>Date</label>
                        <input type='date' value='{$curDateNum}' id='curDate' name='idrDate' class='form-control' readonly />
                    </div>
                    <div class='flex-row no-wrap space-between align-center item-margin-bottom'>
                        <label class='input-label item-margin-right'>Project<span class='text-danger'>*</span></label>
                        <select value='C700' name='project' class='form-control' required>";
                            if ($result = $link->query($contractQry)) {
                                while ($row = $result->fetch_array()) {
                                    echo "<option value ='{$row[0]}'>{$row[1]}</option>";
                                }
                            }
                            
echo "
                        </select>
                    </div>
                    <div class='flex-row no-wrap space-between align-center item-margin-bottom'>
                        <label class='input-label item-margin-right'>Weather<span class='text-danger'>*</span></label>
                        <input type='text' id='weatherDescrip' name='weather' class='form-control' required />
                    </div>
                    <div class='flex-row no-wrap space-between align-center item-margin-bottom'>
                        <label class='input-label item-margin-right'>Shift Hrs<span class='text-danger'>*</span></label>
                        <input type='text' id='shiftHrs' name='shift' class='form-control' required />
                    </div>
                </div>
            </fieldset>
            <fieldset id='safetyData' class='card half-container'>
                <div class='card-header grey-bg'>
                    <h6>Track safety</h6>
                </div>
                <div class='card-body'>
                    <div class='flex-row no-wrap space-between item-margin-bottom'>
                        <label class='input-label'>EIC</label>
                        <input type='text' id='eic' name='EIC' class='form-control' />
                    </div>
                    <div class='flex-row no-wrap space-between item-margin-bottom'>
                        <label class='input-label'>Watchman</label>
                        <input type='text' id='watchman' name='watchman' class='form-control' />
                    </div>
                    <div class='flex-row no-wrap space-between item-margin-bottom'>
                        <label class='input-label'>RAP #</label>
                        <input type='text' id='rapNum' name='rapNum' class='form-control' />
                    </div>
                    <div class='flex-row no-wrap space-between item-margin-bottom'>
                        <label class='input-label'>SSWP #</label>
                        <input type='text' id='sswpNum' name='sswpNum' class='form-control' />
                    </div>
                    <div class='flex-row no-wrap space-between item-margin-bottom'>
                        <label class='input-label'>TCP #</label>
                        <input type='text' id='tcpNum' name='tcpNum' class='form-control' />
                    </div>";
echo "
                </div>
            </fieldset>
        </div>
        
        <div id='locAndDescrip' class='flex-row grey-bg form-section-heading'>
            <div class='item-margin-right'>
                <label class='input-label'>Location<span class='text-danger'>*</span></label>
                <select name='locationID' class='form-control' required>";
                    if ($result = mysqli_query($link, $sqlLoc)) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='{$row[1]}'>{$row[0]}</option>";
                        }
                    }
echo "
                </select>
            </div>
            <div class='flex item-margin-right'>
                <label class='input-label'>Name of operation or discipline<span class='text-danger'>*</span></label>
                <input type='text' name='opDesc' class='form-control full-width' required />
            </div>
        </div>
        <div id='workInputList'>
            <div id='workInputGroup_0' class='form-subsection item-border-bottom item-margin-bottom'>
                <div class='flex-row item-margin-bottom'>
                    <div class='item-margin-right'>
                        <label class='input-label'>Equip/Labor<span class='text-danger'>*</span></label>";
                // the value of this ctrl will determine whether data goes to equip or labor table
echo "
                        <select id='selectEquipLabor_0' class='form-control' required>
                            <option value='labor' selected>Labor</option>
                            <option value='equipment'>Equipment</option>
                        </select>
                    </div>
                    <div class='item-margin-right'>
                        <label class='input-label' id='labelNumEquipLabor_0'># of Personnel<span class='text-danger'>*</span></label>
                        <input type='number' id='equipOrLaborNum_0' name='laborNum_0' class='form-control' style='max-width:110px' required />
                    </div>
                    <div class='item-margin-right flex-grow'>
                        <label class='input-label' id='labelDescEquipLabor_0'>Description of labor<span class='text-danger'>*</span></label>
                        <input type='text' id='equipOrLaborDesc_0' name='laborDesc_0' class='form-control full-width' required />
                    </div>
                    <div class='item-margin-right' style='position:relative'>
                        <label class='input-label'>Notes</label>
                        <button type='button' id='showNotes_0' class='form-control'><i class='typcn typcn-document-text'></i></button>
                        <aside
                            id='notesField_0'
                            style='
                                display: none;
                                position: absolute;
                                right: 46px;
                                bottom: -2px;
                                border: 1px solid #3333;
                                padding: .25rem;
                                background-color: white;
                            '
                        >
                            <textarea name='remarks_0' rows='5' cols='30' maxlength='125' class='form-control'></textarea>
                        </aside>
                    </div>
                </div>
                <div class='pad border-radius grey-bg'>
                    <div class='flex-row item-margin-bottom'>
                        <div class='flex-grow item-margin-right'>
                            <label class='input-label'>Description of task/activity</label>
                            <input id='actInput_0' type='text' class='form-control full-width' />
                        </div>
                        <div class='item-margin-right'>
                            <label class='input-label'>Add Task</label>
                            <button type='button' id='addAct_0' class='btn btn-success block'>Add<i class='typcn typcn-chevron-right-outline'></i></button>
                        </div>
                        <div class='item-margin-right' style='min-width:150px'>
                            <label class='input-label'>Task/activity</label>
                            <select id='actList_0' class='form-control full-width'>
                            </select>
                        </div>
                        <div class='item-margin-right' style='max-width: 100px;'>
                            <label class='input-label'>Hours</label>
                            <input type='number' id='hours_0' class='form-control full-width' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style='text-align: right'>
            <button type='button' id='addLineBtn' class='btn btn-success'>Add Line</button>
        </div>
        <div class='center-content'>
            <button type='submit' class='btn btn-primary btn-lg'>Submit</button>
        </div>
    </form>
</main>
<script src='js/dailyReport.js'></script>";
}
MySqli_Close($link);
include('fileend.php');
?>