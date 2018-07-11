<?php
include('session.php');

/*copy the session UserID to a local variable*/
$UserID = $_SESSION['userID'];
$Username = $_SESSION['username'];
$Role = $_SESSION['role'];
?>

<HTML>
    <HEAD>
        <TITLE>SVBX - Update Password</TITLE>
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </HEAD>
    <?php
            include('SQLFunctions.php');

            $table = 'users_enc';
            $Loc = "SELECT Username, Role, firstname, lastname, Email FROM $table WHERE UserID = ".$UserID;
                //echo '<br>Source table: ' .$table;
?>

    <BODY>
<?php
include('filestart.php');
$link = f_sqlConnect();
?>
        <H1>Update Password</H1>
    <?php
        if($stmt = $link->prepare($Loc)) {
            $stmt->execute();
            $stmt->bind_result($Username, $Role, $firstname, $lastname, $Email);
            while ($stmt->fetch()) {
                echo "
            <FORM action='PasswordChange.php' method='POST' onsubmit='' />
                <p>Update Password for $Username</p>
                <p>$Email</p>
                <input type='hidden' name='userID' value='".$UserID."'>
                <input type='hidden' name='username' value='".$Username."'>
                <form action='change-password.php' method='post' id='register-form'>
                <input class='password-field' type='password' name='oldpw' placeholder='Current Password'><br />
                <br>
                <input  class='password-field' type='password' name='newpw' placeholder='New Password'><br />
                <br>
                <input class='password-field' type='password' name='conpw' placeholder='Confrim Password'><br>
                <br>
                <input class='button' type='submit' name='change' value='Change' />
             </form>
        </FORM>";
            }

        //echo "Description: ".$Description;
                } else {
                    echo '<br>Unable to connect';
                    exit();
                }

        include('fileend.php') ?>
    </BODY>
</HTML>
