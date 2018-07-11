<?php
session_start();
$title = 'SVBX - Login';
include('filestart.php');
?>
    <header class="container page-header masthead">
      <h1 class="page-title"><img class="masthead-logo" src="assets/img/vta.jpg">Silicon Valley Berryessa Extension</h1>
      <p>This site is for use by personnel working upon the SVBX project, if you are not working on the SVBX project, but would like some information, please click on the 'Learn More' button below.
        <a href="http://www.vta.org/News-and-Media/Connect-with-VTA/Phase-I-of-BART-Silicon-Valley-Update#.WqbH0WrwZaQ" target="_blank" class="btn btn-primary btn-xs">Learn more &raquo;</a></p>
    </header>
    <main role="main" class="container main-content">
      <div class="container login-container">
        <?php
            if (isset($_SESSION['errorMsg'])) {
                echo "
                    <div class='thin-grey-border bg-yellow pad'>
                        <p class='mt-0 mb-0'>{$_SESSION['errorMsg']}</p>
                    </div>";
                unset($_SESSION['errorMsg']);
            }
        ?>
        <form action="loginSubmit.php" method="post">
          <fieldset>
            <div class="row">
              <div class="col-md-4 offset-md-4">
                <h2>Username</h2>
                <input type="text" name="username" value="" maxlength="20" class="login-field" />
                <h2>Password</h2>
                <input type="password"  name="password" value="" maxlength="20" class="login-field" />
              <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg login-btn"/>
              <a href="ForgotPassword.php" class="forgot-password-btn">Forgot Password</a>
              </div>
            </div>
          </fieldset>
        </form> <!-- /container -->
      </div>
    </main>
<?php include('fileend.php'); ?>
