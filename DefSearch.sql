$AND = 0;

if($_POST['Search'] == NULL) {
    $sql = file_get_contents("CDList.sql");
    $count = "SELECT COUNT(*) FROM CDL";
} else {
    
    $DefIDS = $_POST['DefID'];
    $SafetyCertS = $_POST['SafetyCert'];
    $SystemAffectedS = $_POST['SystemAffected'];
    $LocationS = $_POST['Location'];
    $SpecLocS = $_POST['SpecLoc'];
    $StatusS = $_POST['Status'];
    $SeverityS = $_POST['Severity'];
    $GroupToResolveS = $_POST['GroupToResolve'];
    $IdentifiedByS = $_POST['IdentifiedBy'];
    $DescriptionS = $_POST['Description'];
    
    $sql = "SELECT 
                A.DefID,
                L.Location, 
                S.Severity, 
                A.DateCreated, 
                Y.SystemAffected, 
                A.Description 
            FROM 
                CDL A 
            LEFT JOIN 
                Location L 
            ON 
                L.LocationID = A.Location
            LEFT JOIN 
                Severity S 
            ON 
                C.SeverityID = A.Severity
            LEFT JOIN 
                System Y
            ON 
                Y.SystemID = A.System";
    $count = "SELECT COUNT(*) FROM CDL A";
    
    if($DefIDS <> NULL) {
       $DefIDSQL = " WHERE A.DefID = '".$DefIDS."'";
       $AND = 1;
    } else {
        $DefIDSQL = "";
    }
    if($SafetyCertS <> NULL) {
        if($AND == 1) {
           $SafetyCertSQL = " AND A.SafetyCert = '".$SafetyCertS."'"; 
       } else {
       $SafetyCertSQL = " WHERE A.SafetyCert = '".$RequirementS."'";
       $AND = 1;
       }
    } else {
        $SafetyCertSQL = "";
    }
    if($SystemAffectedS <> NULL) {
        if($AND == 1) {
           $SystemAffectedSQL = " AND A.SystemAffected = '".$DesignCodeS."'";
        } else {
           $SystemAffectedSQL = " WHERE A.SystemAffected = '".$DesignCodeS."'";
           $AND = 1;
       }
    } else {
        $SystemAffectedSQL = "";
    }
    if($GroupToResolveS <> NULL) {
        if($AND == 1) {
           $GroupToResolveSQL = " AND A.GroupToResolve = '".$DesignCodeS."'";
        } else {
           $GroupToResolveSQL = " WHERE A.GroupToResolve = '".$DesignCodeS."'";
           $AND = 1;
       }
    } else {
        $GroupToResolveSQL = "";
    }
    if($LocationS <> NULL) {
        if($AND == 1) {
            $LocationSQL = " AND A.Location = '".$LocationS."'";
        } else {
            $LocationSQL = " WHERE A.Location = '".$LocationS."'";
            $AND = 1;
        }
    } else {
        $LocationSQL = "";
    }
    if($SpecLocS <> NULL) {
       if($AND == 1) {
            $SpecLocSQL = " AND A.SpecLoc LIKE '%".$SpecLocS."%'";
        } else {
            $SpecLocSQL = " WHERE A.SpecLoc LIKE '%".$SpecLocS."%'";
            $AND = 1;
        }
    } else {
        $SpecLocSQL = "";
    }
    if($StatusS <> 0) {
       if($AND == 1) {
            $StatusSQL = " AND A.Status = '".$StatusS."'";
        } else {
            $StatusSQL = " WHERE A.Status = '".$StatusS."'";
            $AND = 1;
        }
    } else {
        $StatusSQL = "";
    }
    if($SeverityS <> 0) {
       if($AND == 1) {
            $SeveryitySQL = " AND A.Severity = '".$SeverityS."'";
        } else {
            $SeveritySQL = " WHERE A.Severity = '".$SeverityS."'";
            $AND = 1;
        }
    } else {
        $SeveritySQL = "";
    }
    if($IdentifiedByS <> NULL) {
       if($AND == 1) {
            $IdentifiedBySQL = " AND A.IdentifiedBy LIKE '%".$IdentifiedByS."%'";
        } else {
            $IdentifiedBySQL = " WHERE A.IdentifiedBy LIKE '%".$IdentifiedByS."%'";
            $AND = 1;
        }
    } else {
        $IdentifiedBySQL = "";
    }
    if($DescriptionS <> NULL) {
       if($AND == 1) {
            $DescriptionSQL = " AND A.Description LIKE '%".$DescriptionS."%'";
        } else {
            $DescriptionSQL = " WHERE A.Description LIKE '%".$DescriptionS."%'";
            $AND = 1;
        }
    } else {
        $DescriptionSQL = "";
    }
    $sql = $sql.$DefIDSQL.$SafetyCertSQL.$SystemAffectedSQL.$GroupToResolveSQL.$LocationSQL.$SpecLocSQL.$StatusSQL.$SeveritySQL.$IdentifiedBySQL.$DescriptionSQL;
    $count = $count.$DefIDSQL.$SafetyCertSQL.$SystemAffectedSQL.$GroupToResolveSQL.$LocationSQL.$SpecLocSQL.$StatusSQL.$SeveritySQL.$IdentifiedBySQL.$DescriptionSQL;
    
}