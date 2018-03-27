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
        elseif($Role=='V') {
            $RoleT = 'Viewer';
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
            $login = $firstname.' '.$lastname. ' - ' .$RoleT;
        }
    }
    /*if something goes wrong, return the following error*/
    catch (Exception $e)
    {
        $login = 'Unable to process request.';
    }
}
?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #03528B">
      <span class="navbar-brand"><?php echo $login; ?></span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <?php
          if(!isset($_SESSION['UserID'])) {
            echo "
          <li class='nav-item'>
            <a class='nav-link' href='login.php'>Login</a>
          </li>";
          } else {
            echo "
            <li class='nav-item'>
            <a class='nav-link' href='logout.php'>Log out</a>
          </li>";
          }
          if($title == 'SVBX - Home') {
            echo "
          <li class='nav-item'>
            <span class='nav-link disabled'>Home</span>
          </li>";
          } else {
            echo "
          <li class='nav-item'>
            <a class='nav-link' href='stats.php'>Home</a>
          </li>";
          }
          if($title == 'SVBX - Help') {
            echo "
          <li class='nav-item'>
            <span class='nav-link disabled'>Help</span>
          </li>";
          } else {
            echo "
          <li class='nav-item'>
            <a class='nav-link' href='help.php'>Help</a>
          </li>";
          }
          if($Role == 'A' OR $Role == 'S' OR $Role == 'U' OR $Role == 'V') {
            echo "
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Deficiencies</a>
            <div class='dropdown-menu' aria-labelledby='dropdown01'>
              <a class='dropdown-item' href='DisplayDefs.php'>View All Deficiencies</a>
              <a class='dropdown-item' href='DisplayOpenDefs.php'>View Open Deficiencies</a>
              <a class='dropdown-item' href='DisplayClosedDefs.php'>View Closed Deficiencies</a>";
              if($Role == 'A' OR $Role == 'S' OR $Role == 'U') {
            echo "
              <div class='dropdown-divider'></div>
              <a class='dropdown-item' href='DisplayDeletedDefs.php'>View Deleted Deficiencies</a>
              <div class='dropdown-divider'></div>
              <a class='dropdown-item' href='NewDef.php'>Add Deficiency</a>
            </div>
          </li>";
              }
          }
          if($Role == 'A' OR $Role == 'S') {
            echo "
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' id='dropdown02' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Admin Functions</a>
            <div class='dropdown-menu' aria-labelledby='dropdown01'>
              <a class='dropdown-item' href='DisplayEviType.php'>View Evidence Types</a>
              <a class='dropdown-item' href='DisplayLocations.php'>View Locations</a>
              <a class='dropdown-item' href='DisplaySeverity.php'>View Severity Types</a>
              <a class='dropdown-item' href='DisplayStatus.php'>View Status Types</a>
              <a class='dropdown-item' href='DisplaySystems.php'>View Systems</a>
              <a class='dropdown-item' href='DisplayUsers.php'>View Users</a>
              <div class='dropdown-divider'></div>
              <a class='dropdown-item' href='NewUser.php'>Add User</a>
              <a class='dropdown-item' href='NewLocation.php'>Add Location</a>
              <a class='dropdown-item' href='NewSystem.php'>Add System</a>";
              if($Role == 'S') {
                echo "
              <div class='dropdown-divider'></div>
              <a class='dropdown-item' href='NewEvidence.php'>Add Evidence Type</a>
              <a class='dropdown-item' href='NewSeverity.php'>Add Severity</a>
              <a class='dropdown-item' href='NewStatus.php'>Add Status</a>
            </div>
          </li>";
              }
          }
          if($Role == 'A' OR $Role == 'S' OR $Role == 'U' OR $Role == 'V') {
            echo "
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>User Menu</a>
            <div class='dropdown-menu' aria-labelledby='dropdown01'>
              <a class='dropdown-item' href='UpdateProfile.php'>Update Profile</a>
              <a class='dropdown-item' href='UpdatePassword.php'>Change Password</a>";
          }
          ?>
        </ul>
        <?php
          /*
          if(!isset($_SESSION['UserID'])) {
            echo "
              </div>
              </nav>";
          } else {

            echo "
        <form class='form-inline my-2 my-lg-0'>
          <input class='form-control mr-sm-2' type='text' placeholder='Search' aria-label='Search'>
          <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Search</button>
        </form>*/ echo "
      </div>
    </nav>";
        //}
    ?>
