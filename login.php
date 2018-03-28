<?php include('filestart.php'); ?>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <header class="container page-header masthead">
        <h1 class="page-title"><img class="masthead-logo" src="vta.jpg">Silicon Valley Berryessa Extension</h1>
        <p>This site if for use by personel working upon the SVBX project, if you are not working upon the SVBX project, but would like some information, please click on the 'Learn More' button below.
          <a href="http://www.vta.org/News-and-Media/Connect-with-VTA/Phase-I-of-BART-Silicon-Valley-Update#.WqbH0WrwZaQ" target="_blank" class="btn btn-primary btn-xs">Learn more &raquo;</a></p>
      </header>

      <div class="container login-container">
        <form action="loginSubmit.php" method="post">
          <fieldset class="login">
            <div class="row">
              <div class="col-md-4 offset-md-4">
                <h2>Username</h2>
                <input type="text" name="Username" value="" maxlength="20" class="login-field" />
                <h2>Password</h2>
                <input type="password"  name="Password" value="" maxlength="20" class="login-field" />
              <input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg login-btn"/>
              <a href="ForgotPassword.php" class="forgot-password">Forgot Password</a>
              </div>
            </div>
          </fieldset>
        </form> <!-- /container -->
      </div>

    </main>

    <?php include('fileend.php'); ?>
