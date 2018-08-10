<?php
require_once 'sql_functions/sqlFunctions.php';

if(!isset($_SESSION['userID'])) {
    $navHeading = 'Login now';
    $navItems = [
      'Home' => 'dashboard.php',
      'Help' => 'help.php'
    ];
} else {
    /*copy the session UserID to a local variable*/
    $userID = $_SESSION['userID'];
    $username = $_SESSION['username'];
    $Role = $_SESSION['role'];
    $navItems = [
      'Home' => 'dashboard.php',
      'Help' => 'help.php',
      'Deficiencies' => 'defs.php',
      'Safety Certs' => 'viewSC.php'
    ];

  try {
    $link = f_sqlConnect();

    /* Prep SQL statement to find the user name based on the UserID */
    $sql = "SELECT Username, firstname, lastname, Role, inspector FROM users WHERE UserID = $userID";

    /*execute the sql statement*/
    if($result = $link->query($sql)) {
      /*from the sql results, assign the username that returned to the $username variable*/
      while($row = $result->fetch_assoc()) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        if ($row['inspector']) {
          $navItems['Daily Report'] = 'idr.php';
        }
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
    if(!$username) {
        $login = 'Access Error' .$RoleT;
    } else {
        $navHeading = $firstname.' '.$lastname;
    }
  }
  /*if something goes wrong, return the following error*/
  catch (Exception $e) {
      $login = 'Unable to process request.';
  } finally {
      $link->close();
  }
}
?>
<nav class="navbar navbar-expand-md navbar-dark navbar-vta-blue">
  <span class="navbar-brand navbar-heading">
    <?php
      $navbarHref = 'login.php';
      // if UserID is already set, link to userAccount page
      if (isset($_SESSION['userID'])) {
        $navbarHref = 'account.php';
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
        // conditionally render nav items
        foreach($navItems as $text => $href) {
          $classList = 'nav-link';
          $disableLink = ' disabled';
          if (strpos($_SERVER['PHP_SELF'], $href)) $classList .= $disableLink;
          echo "
            <li class='nav-item'>
              <a href='{$href}' class='{$classList}'>{$text}</a>
            </li>
          ";
        }

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
