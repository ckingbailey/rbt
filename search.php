<?php
//include('session.php');
?>

<HTML>
    <HEAD>
        <TITLE>New Deficiency</TITLE>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </HEAD>
    <?php 
            include('SQLFunctions.php');
            
            $link = f_sqlConnect();
            $table = CDL;
            if(isset($_POST['submit'])) {
                // define the list of fields
                $fields = array('SystemAffected', 'Location', 'SpecLoc', 'Status', 'Severity', 'GroupToResolve', 'IdentifedBy', 'Description', 'ActionOwner', 'OldID');
                $conditions = array();
            
                // loop through the defined fields
                foreach($fields as $field){
                    // if the field is set and not empty
                    if(isset($_POST[$field]) && $_POST[$field] != '') {
                        // create a new condition while escaping the value inputed by the user (SQL Injection)
                        $conditions[] = "`$field` LIKE '%" . mysql_real_escape_string($_POST[$field]) . "%'";
                    }
                }
            
                // builds the query
                $query = "SELECT DefID, Location, Description FROM CDL ";
                // if there are conditions defined
                if(count($conditions) > 0) {
                    // append the conditions
                    $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
                }
            
                $result = mysql_query($query);
            }
    ?>
    <BODY>
        <?php include('filestart.php') ?>
        <H1>Search for deficiencies</H1>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <table class='table svbx-table'>
                <tr>
                    <th colspan='4'>
                        <p>Search Deficiencies</p>
                    </th>
                </tr>
                <tr>
                    <th colspan='4'>
                        <p>Search by completing any box with 3 or more letters</p>
                    </th>
                </tr>
                <tr>
                    <td>
                        <p>System Affected</p>
                    </td>
                    <td>
                        <?php
                            $sqlY = "SELECT SystemID, System FROM System ORDER BY System";
                             //if($result = mysqli_query($link,$sqlY)) {
                                    echo "<select name='SystemAffected' value='' id='defdd'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlY) as $row) {
                                        echo "<option value=$row[SystemID]>$row[System]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                    <td>
                        <p>General Location:</p>
                    </td>
                    <td>
                        <?php
                            $sqlL = "SELECT LocationID, LocationName FROM Location ORDER BY LocationName";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='Location' value='' id='defdd'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlL) as $row) {
                                        echo "<option value=$row[LocationID]>$row[LocationName]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Status:</p>
                    </td>
                    <td>
                        <?php
                            $sqlT = "SELECT StatusID, Status FROM Status ORDER BY Status";
                             //if($result = mysqli_query($link,$sqlT)) {
                                    echo "<select name='Status' value='' id='defdd'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlT) as $row) {
                                        echo "<option value=$row[StatusID]>$row[Status]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                    <td>
                        <p>Severity</p>
                    </td>
                    <td>
                        <?php
                            $sqlS = "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName";
                             //if($result = mysqli_query($link,$sqlS)) {
                                    echo "<select name='Severity' value='' id='defdd'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlS) as $row) {
                                        echo "<option value=$row[SeverityID]>$row[SeverityName]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                </tr>
                <tr>    
                    <td>
                        <p>Group to resolve:</p>
                    </td>
                    <td>
                        <?php
                            $sqlY = "SELECT SystemID, System FROM System ORDER BY System";
                             //if($result = mysqli_query($link,$sqlY)) {
                                    echo "<select name='GroupToResolve' value='' id='defdd'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlY) as $row) {
                                        echo "<option value=$row[SystemID]>$row[System]</option>";
                             }
                            echo "</select>";
                        ?>
                    </td>
                    <td>
                        <p>Identified by:</p>
                    </td>
                    <td>
                        <input type="text" name="IdentifiedBy" max="24" id="defdd"/>
                    </td>
                </tr>
                <tr>
                    <td colspan='4' style="text-align:center">
                        <p>Deficiency Description</p>
                    </td>
                </tr>
                <tr>
                    <td Colspan=4>
                        <textarea type="message"  rows="5" cols="99%" name="description" max="1000"></textarea>
                    </td>
                </tr>
                <tr>
                    <th colspan='4'>
                        <p>Optional Information</p>
                    </th>
                </tr>
                <tr>
                    <td>
                        <p>Action Owner:</p>
                    </td>
                    <td>
                        <input type="text" name="ActionOwner" max="24"  id="defdd"/>
                    </td>
                    <td>
                        <p>Old Id:</p>
                    </td>
                    <td>
                        <input type="text" name="OldID" max="24" id="defdd"/>
                    </td>
                </tr>
            </table><br>
            <input type="submit" class="button">
            <input type="reset" class="button">
        </FORM>
        <?php
        if(isset($_POST['submit'])) {
            while($row = mysqli_fetch_array($sql)) {
                echo $row['DefID'] . "<br />";
            }
        }   
        include('fileend.php');
        MySqli_Close($link); ?>
    </BODY>
</HTML>