<HTML>
    <HEAD>
        <TITLE>SVBX - Login</TITLE>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </HEAD>
<BODY>
<div="background">
<div class="index">
  <img src="vta_logo.png" alt="VTA - Solutions that move you" class="logo" />
    <h1 class='index-text'>Silicon Valley Berryessa Extension Project</h1>
  <form action="loginSubmit.php" method="post">
  <fieldset class="login">
    <p style="color:black">
      <label>Username</label>
      <input type="text" name="Username" value="" maxlength="20" />
    </p>
    <p style="color:black">
      <label>Password</label>
      <input type="password"  name="Password" value="" maxlength="20" /><br>
      <a style="color: black; font-size: 10px" href="ForgotPassword.php">Forgot Password</a>
    </p>
    <p>
      <input type="submit" name="submit" value="Login" />
    </p>
  </fieldset>
  </form>
  </div>
  </div>
<?php include 'footer.html';?>
</body>
</html>