<?php
include('session.php');
include('SQLFunctions.php');
$link = f_sqlConnect();
$Role = $_SESSION['Role'];
$title = "SVBX - New Deficiency";
if($Role == 'V') {
    header('location: unauthorised.php');
}
include('filestart.php')
?>
<header class="container page-header">
    <h1 class="page-title">Add New Deficiency</h1>
</header>
<main role="main" class="container main-content">
    <form action="RecDef.php" method="POST">
        <fieldset class="item-margin-bottom">
            <legend class="bg-secondary text-white form-section-heading">Required Information</legend>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Affect Safety Cert</label>
                    <select name='SafetyCert' class="form-control def-input" required>
                        <option value='' disabled selected>Y/N</option>
                        <option value='1'>Yes</option>
                        <option value='2'>No</option>
                    </select>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">System Affected</label>
                    <?php
                        $sqlY = "SELECT SystemID, System FROM System ORDER BY System";
                         //if($result = mysqli_query($link,$sqlY)) {
                                echo "<select name='SystemAffected' class='form-control def-input' required>
                                        <option value='' disabled selected>Choose System</option>";
                                foreach(mysqli_query($link,$sqlY) as $row) {
                                    echo "<option value={$row[SystemID]}>{$row[System]}</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">General Location</label>
                    <?php
                        $sqlL = "SELECT LocationID, LocationName FROM Location ORDER BY LocationName";
                         //if($result = mysqli_query($link,$sqlL)) {
                                echo "<select name='Location' class='form-control def-input' required>
                                        <option value='' disabled selected>Choose Location</option>";
                                foreach(mysqli_query($link,$sqlL) as $row) {
                                    echo "<option value={$row[LocationID]}>{$row[LocationName]}</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">Specific Location</label>
                    <input type="text" name="SpecLoc" maxlength="55" class="form-control def-input" required/>
                </div>
            </div>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Status</label>
                    <?php
                        $sqlT = "SELECT StatusID, Status FROM Status WHERE StatusID <> '3' ORDER BY StatusID";
                         //if($result = mysqli_query($link,$sqlT)) {
                                echo "<select name='Status' class='form-control def-input' required>
                                        <option value='' disabled selected>Choose Status</option>";
                                foreach(mysqli_query($link,$sqlT) as $row) {
                                    echo "<option value={$row[StatusID]}>{$row[Status]}</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">Severity</label>
                    <?php
                        $sqlS = "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName";
                         //if($result = mysqli_query($link,$sqlS)) {
                                echo "<select name='Severity' class='form-control def-input' required>
                                        <option value='' disabled selected>Choose Severity</option>";
                                foreach(mysqli_query($link,$sqlS) as $row) {
                                    echo "<option value={$row[SeverityID]}>{$row[SeverityName]}</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">To be resolved by</label>
                    <input type='date' name='DueDate' class="form-control def-input" required/>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">Required for</label>
                    <?php
                        $sqlRB = "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY ReqByID";
                         //if($result = mysqli_query($link,$sqlS)) {
                                echo "<select name='RequiredBy' class='form-control def-input' required>
                                        <option value='' disabled selected>Requirement</option>";
                                foreach(mysqli_query($link,$sqlRB) as $row) {
                                    echo "<option value=$row[ReqByID]>$row[RequiredBy]</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Group to resolve</label>
                    <?php
                        $sqlY = "SELECT SystemID, System FROM System ORDER BY System";
                         //if($result = mysqli_query($link,$sqlY)) {
                                echo "<select name='GroupToResolve' class='form-control def-input' required>
                                        <option value='' disabled selected>Group</option>";
                                foreach(mysqli_query($link,$sqlY) as $row) {
                                    echo "<option value=$row[SystemID]>$row[System]</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">Identified by</label>
                    <input type="text" name="IdentifiedBy" maxlength="24" class="form-control def-input" required/>
                </div>
            </div>
            <div class="constrainer form-subsection item-border-bottom item-margin-bottom center-element">
                <div class="flex-column no-wrap">
                    <label class="input-label label-breakline">Deficiency Description</label>
                    <textarea name="description" rows="5" maxlength="1000" class="form-control textarea-full-width" required></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset class="item-margin-bottom">
            <legend class="bg-secondary text-white form-section-heading">Optional Information</legend>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Spec or Code</label>
                    <input type="text" name="Spec" maxlength="55"  id="" class="form-control def-input"/>
                </div>
            </div>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Action Owner</label>
                    <input type="text" name="ActionOwner" maxlength="24"  id="" class="form-control def-input"/>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">Old Id</label>
                    <input type="text" name="OldID" maxlength="24" id="" class="form-control def-input"/>
                </div>
            </div>
            <div class="constrainer form-subsection item-border-bottom item-margin-bottom item-margin-bottom center-element">
                <div class="flex-column no-wrap">
                    <label class="input-label label-breakline">More Information</label>
                    <textarea name="comments" rows="5" maxlength="1000" class="form-control textarea-full-width"></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset class="item-margin-bottom">
            <legend class="bg-secondary text-white form-section-heading">Closure Information</legend>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Evidence Type</label>
                    <?php
                        $sqlE = "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType";
                         //if($result = mysqli_query($link,$sqlE)) {
                                echo "<select name='EvidenceType' id='' class='form-control def-input'></option>
                                        <option value='' disabled selected>Choose Type</option>";
                                foreach(mysqli_query($link,$sqlE) as $row) {
                                    echo "<option value=$row[EviTypeID]>$row[EviType]</option>";
                         }
                        echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-subsection item-border-bottom item-margin-bottom form-group">
                <div class="half-container">
                    <label class="input-label item-margin-right">Evidence Repository</label>
                    <select name='Repo' id='' class="form-control def-input">
                        <option value='' disabled selected>Choose Repo</option>
                        <option value=''></option>
                        <option value='A'>Aconex</option>
                        <option value='S'>SharePoint</option>
                    </select>
                </div>
                <div class="half-container">
                    <label class="input-label item-margin-right">Repository Number</label>
                    <input type="text" name="EvidenceLink" maxlength="255"  id='' class="form-control def-input"/>
                </div>
            </div>
            <div class="constrainer form-subsection item-border-bottom item-margin-bottom center-element">
                <div class="flex-column no-wrap">
                    <label class="input-label label-breakline">Closure Comments</label>
                    <textarea name="ClosureComments" rows="5" maxlength="1000" class="form-control textarea-full-width"></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset class="center-content">
            <button type='submit' value='submit' class='btn btn-primary btn-lg'>Submit</button>
            <button type='reset' value='reset' class='btn btn-primary btn-lg'>Reset</button>
        </fieldset>
    </form>
</main>
<?php 
MySqli_Close($link);
include('fileend.php');
?>
