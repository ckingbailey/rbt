<?php
require_once('SQLFunctions.php');

if(!isset($_SESSION['UserID'])) {
    $navHeading = 'Login now';
} else {
    /*copy the session UserID to a local variable*/
    $UserID = $_SESSION['UserID'];
    $Username = $_SESSION['Username'];
    $Role = $_SESSION['Role'];

  try {
    /*Connect to CRUD Database*/
    $link = f_sqlConnect();

    /* Prep SQL statement to find the user name based on the UserID */
    $sql = "SELECT Username, firstname, lastname, Role FROM users_enc WHERE UserID = ".$UserID;

    /*execute the sql statement*/
    if($result=mysqli_query($link,$sql)) {
      /*from the sql results, assign the username that returned to the $username variable*/
      while($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
      }
    }

    if($Role=='S') {
        $RoleT = 'Super Admin';
    } elseif($Role=='A') {
        $RoleT = 'Administrator';
    } elseif($Role=='U') {
        $RoleT = 'User';
    } elseif($Role=='V') {
        $RoleT = 'Viewer';
    } else {
        $RoleT = '';
    }

    /* Return Status to User*/
    if($Username == false) {
        $login = 'Access Error' .$RoleT;
    } else {
        $navHeading = $firstname.' '.$lastname;
    }
  }
  /*if something goes wrong, return the following error*/
  catch (Exception $e) {
      $login = 'Unable to process request.';
  }
}
?>
<nav class="navbar navbar-expand-md navbar-dark navbar-vta-blue fixed-top">
  <span class="navbar-brand navbar-heading">
    <?php
      $navbarHref = 'login.php';
      // if UserID is already set, link to userAccount page
      if (isset($_SESSION['UserID'])) {
        $navbarHref = 'userAccount.php';
      }
      echo "<a href='{$navbarHref}' class='navbar-link navbar-brand-link'>{$navHeading}</a>";
    ?>
  </span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <?php
        foreach([
          'Home' => 'stats.php',
          'Help' => 'help.php',
          'Deficiencies' => 'DisplayDefs.php',
          'Safety Certs' => 'ViewSC.php'
        ] as $text => $href) {
          $classList = 'nav-link';
          $disableLink = ' disabled';
          if (strpos($_SERVER['PHP_SELF'], $href)) $classList .= $disableLink;
          echo "
            <li class='nav-item'>
              <a href='{$href}' class='{$classList}'>{$text}</a>
            </li>
          ";
        }
        
        // if($title == 'SVBX - Home') $classList .= ' disabled';
        // echo "
        //   <li class='nav-item'>
        //     <a class='{$classList}{disableLink($title)}' href='stats.php'>Home</a>
        //   </li>";
        // if($title == 'SVBX - Help') $classList .= ' disabled';
        // echo "
        //   <li class='nav-item'>
        //     <a class='{$classList}{disableLink($title)}' href='help.php'>Help</a>
        //   </li>";
        // if($Role == 'A' OR $Role == 'S' OR $Role == 'U' OR $Role == 'V') {
        //   if (strpos($title, 'Deficiencies')) $classList .= ' disabled';
        //   echo "
        //     <li class='nav-item'>
        //       <a class='{$classList}{disableLink($title)}' href='DisplayDefs.php'>Deficiencies</a>
        //     </li>";
        // }
        // if($Role == 'A' OR $Role == 'S' OR $Role == 'U' OR $Role == 'V') {
        //   if (strpos($title, 'Safety Certifications')) $classList .= ' disabled';
        //   echo "
        //     <li class='nav-item'>
        //       <a class='{$classList}{disableLink($title)}' href='ViewSC.php'>Safety Certs</a>
        //     </li>";
        // }
        if($navHeading != 'Login now') {
          echo '
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          ';
        }
      ?>
    </ul>
  </div>
</nav>
