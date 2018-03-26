<?php
include('session.php');
include('SQLFunctions.php');
$link = f_sqlConnect();
$Role = $_SESSION['Role'];
$title = "SVBX - New Deficiency";
    if($Role == 'V') {
        header('location: unauthorised.php');
    }
include('filestart.php') ?>
        <div class='container'>
        <FORM action="RecDef.php" method="POST">
            <table class='vdtable'>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'>
                        <p>New Deficiency</p>
                    </th>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'>
                        <p>Required Information</p>
                    </th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtd'>
                        <p>Affect Safety Cert:</p>
                    </td>
                    <td class='vdtd'>
                        <select name'SafetyCert' value='' id='defdd' required></option>
                        <option value=''></option>
                        <option value='Y'>Yes</option>
                        <option value='N'>No</option>
                    </td>
                    <td class='vdtd'>
                        <p>System Affected</p>
                    </td>
                    <td class='vdtd'>
                        <?php
                            $sqlY = "SELECT SystemID, System FROM System ORDER BY System";
                             //if($result = mysqli_query($link,$sqlY)) {
                                    echo "<select name='SystemAffected' value='' id='defdd' required></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlY) as $row) {
                                        echo "<option value=$row[SystemID]>$row[System]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtd'>
                        <p>General Location:</p>
                    </td>
                    <td class='vdtd'>
                        <?php
                            $sqlL = "SELECT LocationID, LocationName FROM Location ORDER BY LocationName";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='Location' value='' id='defdd' required></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlL) as $row) {
                                        echo "<option value=$row[LocationID]>$row[LocationName]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                    <td class='vdtd'>
                        <p>Specific Location:</p>
                    </td>
                    <td class='vdtd'>
                        <input type="text" name="SpecLoc" max="55" id="defdd" required/>
                    </td>
                </tr>
                <tr class='vdtr'>    
                    <td class='vdtd' id='status'>
                        <p>Status:</p>
                    </td>
                    <td class='vdtd'>
                        <?php
                            $sqlT = "SELECT StatusID, Status FROM Status WHERE StatusID <> '3' ORDER BY StatusID";
                             //if($result = mysqli_query($link,$sqlT)) {
                                    echo "<select name='Status' value='' id='defdd' required></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlT) as $row) {
                                        echo "<option value=$row[StatusID]>$row[Status]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                    <td class='vdtd'>
                        <p>Severity</p>
                    </td>
                    <td class='vdtd'>
                        <?php
                            $sqlS = "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName";
                             //if($result = mysqli_query($link,$sqlS)) {
                                    echo "<select name='Severity' value='' id='defdd' required></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlS) as $row) {
                                        echo "<option value=$row[SeverityID]>$row[SeverityName]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr class='vdtr'>    
                    <td class='vdtd'>
                        <p>To be resolved by:</p>
                    </td>
                    <td class='vdtd'>
                        <input type='date' name='DueDate' id='defdd'/>
                    </td>
                    <td class='vdtd'>
                        <p>Required for:</p>
                    </td>
                    <td class='vdtd'>
                        <?php
                            $sqlRB = "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY ReqByID";
                             //if($result = mysqli_query($link,$sqlS)) {
                                    echo "<select name='RequiredBy' value='' id='defdd' required></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlRB) as $row) {
                                        echo "<option value=$row[ReqByID]>$row[RequiredBy]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr class='vdtr'>    
                    <td class='vdtd'>
                        <p>Group to resolve:</p>
                    </td>
                    <td class='vdtd'>
                        <?php
                            $sqlY = "SELECT SystemID, System FROM System ORDER BY System";
                             //if($result = mysqli_query($link,$sqlY)) {
                                    echo "<select name='GroupToResolve' value='' id='defdd' required></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlY) as $row) {
                                        echo "<option value=$row[SystemID]>$row[System]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                    <td class='vdtd'>
                        <p>Identified by:</p>
                    </td>
                    <td class='vdtd'>
                        <input type="text" name="IdentifiedBy" max="24" id="defdd" required/>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style="text-align:center"  class='vdtd'>
                        <p>Deficiency Description</p>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4>
                        <textarea type="message"  rows="5" cols="99%" name="description" max="1000" required></textarea>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'>
                        <p>Optional Information</p>
                    </th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtd'>
                        <p>Spec or Code:</p>
                    </td>
                    <td colspan="3" class='vdtd'>
                        <input type="text" name="Spec" max="55"  id="defdd"/>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtd'>
                        <p>Action Owner:</p>
                    </td>
                    <td class='vdtd'>
                        <input type="text" name="ActionOwner" max="24"  id="defdd"/>
                    </td>
                    <td class='vdtd'>
                        <p>Old Id:</p>
                    </td>
                    <td class='vdtd'>
                        <input type="text" name="OldID" max="24" id="defdd"/>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style="text-align:center"  class='vdtd'>
                        <p>More Information</p>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4 class='vdtd'>
                        <textarea type="message"  rows="5" cols="99%" name="comments" max="1000"></textarea>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <th colspan='4' class='vdth'>
                        <p>Closure Information</p>
                    </th>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtd'>
                        <p>Evidence Type:</p>
                    </td>
                    <td class='vdtd' colspan='3'>
                        <?php
                            $sqlE = "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType";
                             //if($result = mysqli_query($link,$sqlE)) {
                                    echo "<select name='EvidenceType' value='' id='defdd'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlE) as $row) {
                                        echo "<option value=$row[EviTypeID]>$row[EviType]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td class='vdtd'>
                        <p>Evidence Repository:</p>
                    </td>
                    <td class='vdtd'>
                        <select name'Repo' value='' id='defdd'></option>
                        <option value=''></option>
                        <option value='A'>Aconex</option>
                        <option value='S'>SharePoint</option>
                    </td>
                    <td class='vdtd'>
                        <p>Repository Number</p>
                    </td>
                    <td class='vdtd'>
                        <input type="text" name="EvidenceLink" max="255"  id='defdd'/>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td colspan='4' style="text-align:center"  class='vdtd'>
                        <p>Closure Comments</p>
                    </td>
                </tr>
                <tr class='vdtr'>
                    <td Colspan=4 class='vdtd'>
                        <textarea type="message"  rows="5" cols="99%" name="ClosureComments" max="1000"></textarea>
                    </td>
                </tr>
            </table>
            </div><br>
            <div  style='display: flex; align-items: center; justify-content: center; hspace:20'>
            <input type='submit' value='submit' class='btn btn-primary btn-lg' /><p> </p>
            <div style='width:5px; height:auto; display:inline-block'></div>
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
            </form>
            </div>
        <br />
        <br />
        <?php 
        MySqli_Close($link);
        include('fileend.php');
        ?>
