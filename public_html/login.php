<!DOCTYPE html>
<html lang='en'>
<?php
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require "$baseDir/vendor/autoload.php";
require "$baseDir/inc/session.php";
require_once "$baseDir/config.php";

if (!empty($_SESSION['errorMsg'])) {
  $errorMsg = $_SESSION['errorMsg'];
  unset($_SESSION['errorMsg']);
}

$title = PROJECT_NAME . ' - Login';
// if user is already logged in, set navbarHeading to their name and display a warning
$navbarHeading = !empty($_SESSION['username'])
  ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
      ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
      : $_SESSION['username'] )
  : '';
$errorMsg = $navbarHeading ? 'User is already logged in' : '';
// if user is not logged in do not display any navitems
$navItems = !empty($navbarHeading) ? '' : [];

// init Twig
$loader = new Twig_Loader_Filesystem("$baseDir/templates");
$twig = new Twig_Environment($loader,
    [
        'debug' => true
    ]
);
$twig->addExtension(new Twig_Extension_Debug());

$twig->display('head.html.twig', [ 'title' => $title ]);
?>
<body>
  <?php $twig->display('nav.html.twig', [ 'navbarHeading' => $navbarHeading, 'navItems' => $navItems ]); ?>
    <header class="container page-header masthead">
      <img class="masthead-logo" src="assets/img/brand_logo.jpg" alt="brand logo">
      <h1 class="page-title"><?php echo PROJECT_NAME ?></h1>
      <p><a href="" target="_blank" class="btn btn-primary btn-xs">Learn more &raquo;</a></p>
    </header>
    <main role="main" class="container main-content">
      <div class="container login-container">
        <?php
          if (!empty($errorMsg)) {
            echo "
                <div class='thin-grey-border bg-yellow pad'>
                    <p class='mt-0 mb-0'>$errorMsg</p>
                </div>";
            unset($errorMsg);
          }
        ?>
        <form action="commit/loginSubmit.php" method="post">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <h2>Username</h2>
              <input type="text" name="username" value="" maxlength="20" class="login-field" />
              <h2>Password</h2>
              <input type="password"  name="password" value="" maxlength="20" class="login-field" />
              <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg login-btn"/>
            </div>
          </div>
        </form>
      </div>
    </main>
<?php include('fileend.php'); ?>
