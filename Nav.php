<?php      
require_once('SQLFunctions.php');
session_start();

if(!isset($_SESSION['UserID']))
{
    $login = 'Not logged in';
}
else
{
    /*copy the session UserID to a local variable*/
    $UserID = $_SESSION['UserID'];
    $Username = $_SESSION['Username'];
    $Role = $_SESSION['Role'];
    /*echo "<br />UserID=".$UserID;*/
    
    try
    {
         /*Connect to CRUD Database*/
        $link = f_sqlConnect();

        /* Prep SQL statement to find the user name based on the UserID */
        $sql = "SELECT Username, firstname, lastname, Role FROM users_enc WHERE UserID = ".$UserID;
        /*echo "<br />".$sql."<br />";*/
        
        /*execute the sql statement*/
        if($result=mysqli_query($link,$sql)) 
        {
          /*from the sql results, assign the username that returned to the $username variable*/    
          while($row = mysqli_fetch_assoc($result)) {
            //$Username = $row['Username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            //$Role = $row['Role'];
            
            //echo "<br />username=".$username;
          }        
        }
        
        if($Role=='S') {
            $RoleT = 'Super Admin';
        }
        elseif($Role=='A') {
            $RoleT = 'Administrator';
        }
        elseif($Role=='U') {
            $RoleT = 'User';
        }
        else {
            $RoleT = '';
        }

        /* Return Status to User*/
        if($Username == false)
        {
            $login = 'Access Error<br />' .$RoleT;;
        }
        else
        {
            $login = $firstname.' '.$lastname. '<br />' .$RoleT;
        }
    }
    /*if something goes wrong, return the following error*/
    catch (Exception $e)
    {
        $login = 'Unable to process request.';
    }
}

echo "<nav>";
echo $login;
?>
    <br />
    <br />
    <img src="vta.jpg" width="95%" align="middle"/><br />
    <p>Silicon Valley Berryessa Extension Project</p>
    Build 0.3
<?php 

if(!isset($_SESSION['UserID']))
{
    echo "  
        <br />
        <a href='login.php' style='font-size:20px'>Login</a><br />
        <a href='help.php' style='font-size:20px'>Help</a><br />";
} else {
    echo "
        <h4>Navigation</h4>
        <a href='stats.php' style='font-size:20px'>Home</a><br />
        <a href='DisplayDefs.php' style='font-size:20px'>Deficiencies</a><br />
        <a href='DisplayEviType.php' style='font-size:20px'>Evidence Types</a><br />
        <a href='DisplayLocations.php' style='font-size:20px'>Locations</a><br />
        <a href='DisplaySeverity.php' style='font-size:20px'>Severities</a><br />
        <a href='DisplayStatus.php' style='font-size:20px'>Statuses</a><br />
        <a href='DisplaySystems.php' style='font-size:20px'>Systems</a><br />
        <a href='DisplayUsers.php' style='font-size:20px'>Users</a><br />
        <br />
        <a href='UpdatePassword.php' style='font-size:20px'>Change Password</a><br />
        <a href='logout.php' style='font-size:20px'>Logout</a><br />
        <a href='help.php' style='font-size:20px'>Help</a><br />";
}
if($Role == 'A' OR $Role == 'S' OR $Role == 'U')
{       
        
        echo "
        <br /><a href='NewDef.php' style='font-size:20px'>Add Deficiency</a><br />
        <br />";
}
if($Role == 'A' OR $Role == 'S')
{
        echo "  
        <h4>Administration</h4>
        <a href='NewEvidence.php' style='font-size:20px'>Add Evidence Type</a><br />
        <a href='NewLocation.php' style='font-size:20px'>Add Location</a><br />
        <a href='NewSeverity.php' style='font-size:20px'>Add Severity</a><br />
        <a href='NewStatus.php' style='font-size:20px'>Add Status</a><br />
        <a href='NewSystem.php' style='font-size:20px'>Add System</a><br />
        <a href='NewUser.php' style='font-size:20px'>Add User</a><br />";
} else {
    
}
//exit()
?>
</nav>