<?php
include('session.php');
$Role = $_SESSION['Role'];
$title = "SVBX - Deficiency No".$DefID;
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include('filestart.php'); 
$link = f_sqlConnect();
$AND = 0;

if($_POST['Search'] == NULL) {
    $sql = file_get_contents("SafetyCert.sql");
    $count = "SELECT COUNT(*) FROM SafetyCert A";
} else {
    
    $ItemS = $_POST['Item'];
    $RequirementS = $_POST['Requirement'];
    $DesignCodeS = $_POST['DesignCode'];
    $DesignSpecS = $_POST['DesignSpec'];
    $ContractNoS = $_POST['ContractNo'];
    $ControlNoS = $_POST['ControlNo'];
    $ElementGroupS = $_POST['ElementGroup'];
    $CertElementS = $_POST['CertElement'];
    
    $sql = "SELECT 
                A.CertID,
                A.Item, 
                A.Requirement, 
                A.DesignCode, 
                A.DesignSpec, 
                B.Contract, 
                A.ControlNo, 
                C.ElementGroup, 
                D.CertifiableElement 
            FROM 
                SafetyCert A 
            LEFT JOIN 
                Contract B 
            ON 
                B.ContractID = A.ContractNo
            LEFT JOIN 
                ElementGroup C 
            ON 
                C.EG_ID = A.ElementGroup
            LEFT JOIN 
                CertifiableElement D 
            ON 
                D.CE_ID = A.CertElement";
    $count = "SELECT COUNT(*) FROM SafetyCert A";
    
    if($ItemS <> NULL) {
       $ItemSQL = " A.Item = '".$ItemS."'";
       $AND = 1;
    } else {
        $ItemSQL = "";
    }
    if($RequirementS <> NULL) {
        if($AND == 1) {
           $ReqSQL = " AND A.Requirement LIKE '%".$RequirementS."%'"; //LIKE '%123456%'
       } else {
       $ReqSQL = " WHERE A.Requirement LIKE '%".$RequirementS."%'";
       $AND = 1;
       }
    } else {
        $ReqSQL = "";
    }
    if($DesignCodeS <> NULL) {
        if($AND == 1) {
           $DesignCodeSQL = " AND A.DesignCode LIKE '%".$DesignCodeS."%'";
        } else {
           $DesignCodeSQL = " WHERE A.DesignCode LIKE '%".$DesignCodeS."%'";
           $AND = 1;
       }
    } else {
        $DesignCodeSQL = "";
    }
    if($DesignSpecS <> NULL) {
        if($AND == 1) {
            $DesignSpecSQL = " AND A.DesignSpec LIKE '%".$DesignSpecS."%'";
        } else {
            $DesignSpecSQL = " WHERE A.DesignSpec LIKE '%".$DesignSpecS."%'";
            $AND = 1;
        }
    } else {
        $DesignSpecSQL = "";
    }
    if($ContractNoS <> NULL) {
       if($AND == 1) {
            $ContractNoSQL = " AND A.ContractNo = '".$ContractNoS."'";
        } else {
            $ContractNoSQL = " WHERE A.ContractNo = '".$ContractNoS."'";
            $AND = 1;
        }
    } else {
        $ContractNoSQL = "";
    }
    if($ControlNoS <> 0) {
       if($AND == 1) {
            $ControlNoSQL = " AND A.ControlNo = '".$ControlNoS."'";
        } else {
            $ControlNoSQL = " WHERE A.ControlNo = '".$ControlNoS."'";
            $AND = 1;
        }
    } else {
        $ControlNoSQL = "";
    }
    if($ElementGroupS <> 0) {
       if($AND == 1) {
            $ElementGroupSQL = " AND A.ElementGroup = '".$ElementGroupS."'";
        } else {
            $ElementGroupSQL = " WHERE A.ElementGroup = '".$ElementGroupS."'";
            $AND = 1;
        }
    } else {
        $ElementGroupSQL = "";
    }
    if($CertElementS <> 0) {
       if($AND == 1) {
            $CertElementSQL = " AND A.CertElement = '".$CertElementS."'";
        } else {
            $CertElementSQL = " WHERE A.CertElement = '".$CertElementS."'";
            $AND = 1;
        }
    } else {
        $CertElementSQL = "";
    }
    $sql = $sql.$ItemSQL.$ReqSQL.$DesignCodeSQL.$DesignSpecSQL.$ContractNoSQL.$ControlNoSQL.$ElementGroupSQL.$CertElementSQL;
    $count = $count.$ItemSQL.$ReqSQL.$DesignCodeSQL.$DesignSpecSQL.$ContractNoSQL.$ControlNoSQL.$ElementGroupSQL.$CertElementSQL;
    
}



?>
    <table border='1' style='width:96%;margin-left:auto;margin-right:auto;margin-top:100px'>
        <tr>
            <th class='vdth' colspan='8'>Search</td>
        </tr>
        <tr>
            <th class='vdth' style='width:5%'>Item</td>
            <th class='vdth' style='width:26%'>Safety/Security<br />Requirement</td>
            <th class='vdth' style='width:15%'>Design<br />Codes/Standards</td>
            <th class='vdth' style='width:15%'>Design Specifications/Criteria</td>
            <th class='vdth' style='width:10%'>Contract No.</td>
            <th class='vdth' style='width:10%'>Control No.</td>
            <th class='vdth' style='width:10%'>Element Group</td>
            <th class='vdth' style='width:10%'>Certifiable Element</td>
                    
        </tr>
        <tr>
            <form action="ViewSC.php" method="POST">
                <input type='hidden' name='Search' value=1>
                    <td><?php
                            $sqlI = "SELECT Item FROM SafetyCert ORDER BY Item";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='Item'' style='width:100%' value='".$ItemS."'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlI) as $row) {
                                        echo "<option value='$row[Item]'";
                                            if($row['Item'] == $ItemS) {
                                                echo " selected>$row[Item]</option>";
                                            } else { echo ">$row[Item]</option>";
                                            }
                                    }
                            echo "</select>";
                        ?></td>
                    <td><input type="text" name="Requirement" max="55" style="width:100%" value="<?php echo $RequirementS ?>" /></td>
                    <td><input type="text" name="DesignCode" max="55" style="width:100%" value="<?php echo $DesignCodeS ?>" /></td>
                    <td><input type="text" name="DesignSpec" max="55" style="width:100%" value="<?php echo $DesignSpecS ?>" /></td>
                    <td><?php
                            $sqlC = "SELECT ContractID, Contract FROM Contract ORDER BY Contract";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='ContractNo' style='width:100%' value='".$ContractNoS."'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlC) as $row) {
                                        echo "<option value='$row[ContractID]'";
                                            if($row['ContractID'] == $ContractNoS) {
                                                echo " selected>$row[Contract]</option>";
                                            } else { echo ">$row[Contract]</option>";
                                            }
                                    }
                            echo "</select>";
                        ?></td>
                    <td><?php
                            $sqlCN = "SELECT DISTINCT ControlNo FROM SafetyCert ORDER BY ControlNo";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='ControlNo'' style='width:100%' value='".$ControlNoS."'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlCN) as $row) {
                                        echo "<option value='$row[ControlNo]'";
                                            if($row['ControlNo'] == $ControlNoS) {
                                                echo " selected>$row[ControlNo]</option>";
                                            } else { echo ">$row[ControlNo]</option>";
                                            }
                                    }
                            echo "</select>";
                        ?></td>
                    <td><?php
                            $sqlE = "SELECT EG_ID, ElementGroup FROM ElementGroup ORDER BY ElementGroup";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='ElementGroup' style='width:100%' value='".$ElementGroupS."'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlE) as $row) {
                                        echo "<option value='$row[EG_ID]'";
                                            if($row['EG_ID'] == $ElementGroupS) {
                                                echo " selected>$row[ElementGroup]</option>";
                                            } else { echo ">$row[ElementGroup]</option>";
                                            }
                                    }
                            echo "</select>";
                        ?></td>
                    <td><?php
                            $sqlCE = "SELECT CE_ID, CertifiableElement FROM CertifiableElement ORDER BY CertifiableElement";
                             //if($result = mysqli_query($link,$sqlL)) {
                                    echo "<select name='CertElement' style='width:100%' value='".$CertElementS."'></option>";
                                    echo "<option value=''></option>";
                                    foreach(mysqli_query($link,$sqlCE) as $row) {
                                        echo "<option value='$row[CE_ID]'";
                                            if($row['CE_ID'] == $CertElementS) {
                                                echo " selected>$row[CertifiableElement]</option>";
                                            } else { echo ">$row[CertifiableElement]</option>";
                                            }
                                    }
                            echo "</select>";
                        ?></td>
        </tr>
    </table>
    <br />
    <div  style='display: flex; align-items: center; justify-content: center; hspace:20'>
            <input type='submit' value='Submit' class='btn btn-primary btn-lg' /><p> </p>
    </form>
    <form action="ViewSC.php">
            <input type='submit' value='Reset' class='btn btn-primary btn-lg'  />
    </form>
    </div>
        <?php 
        if($result = mysqli_query($link,$count)) {
            echo"
                <br />
                <table class='sumtable'>
                <tr class='sumtr'>
                <td class='sumtd'>Safety Requirements Found: </td>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<td class='sumtd'>{$row[0]}</td>";
            }
        }
            echo "</table>";
            //echo "<br />SQL: ".$sql;
            //echo "<br />Count: ".$count;
        ?>
<?php
    if($result = mysqli_query($link,$sql)) {
    echo "<table border='1' style='width:96%;margin-left:auto;margin-right:auto;margin-top:100px'>
                <tr>
                    <th class='vdth' colspan='8' height='50'><p>Certification Stage</p></th>
                </tr>
                <tr>
                    <th class='vdth' style='width:5%'>Item</td>
                    <th class='vdth' style='width:26%'>Safety/Security<br />Requirement</td>
                    <th class='vdth' style='width:15%'>Design<br />Codes/Standards</td>
                    <th class='vdth' style='width:15%'>Design Specifications/Criteria</td>
                    <th class='vdth' style='width:10%'>Contract No.</td>
                    <th class='vdth' style='width:10%'>Control No.</td>
                    <th class='vdth' style='width:10%'>Element Group</td>
                    <th class='vdth' style='width:10%'>Certifiable Element</td>
                    
                </tr>";
                while($row = mysqli_fetch_array($result)) { 
                    echo "
                <tr>
                    <td style='vertical-align:Top;text-align:left'>{$row[1]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[2]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[3]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[4]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[5]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[6]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[7]}</td>
                    <td style='vertical-align:Top;text-align:left'>{$row[8]}</td>
                </tr>";
                    }  
                echo "</table><br>";
                } else {  
                    echo "
                    <div='container'>
                    <br />
                    <br />
                    <br />
                    <br>Unable to connect<br>
                    </div>";
                    echo $sql.'<br /><br />';
                    //echo mysqli_error();
                    //echo "<BR>Def ID: ".$DefID;
                  exit();  
                } 
    include('fileend.php');
    MySqli_Close($link); 
?>