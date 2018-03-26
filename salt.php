<?php 
function cryptPass($input, $rounds = 10) {
    $salt = "$2y$14$";
    $saltChars = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    for($i = 0; $i < 22; $i++) {
        $salt .= $saltChars[array_rand($saltChars)];
    }
    return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
}
$inputPass = "password";
$pass = "oveewu";
$hashedPass = cryptPass($pass);
echo "<br>Hashed Password: " .$hashedPass;
if(crypt($inputPass, $hashedPass) == $hashedPass) {
    echo "<br />Password is a match = log user in";
} else {
    echo "<br />Password does not match = do not log in";
}


?>

            <p>
              <label>Security Questions</label>
              <?php
                  $secQ = "SELECT SecQID, secQ FROM secQ ORDER BY SecQID";
                   //if($result = mysqli_query($link,$sqlY)) {
                          echo "<select name='secQ' value='' id='defdd' required></option>";
                          echo "<option value=''></option>";
                          foreach(mysqli_query($link,$secQ) as $row) {
                              echo "<option value=$row[SecQID]>$row[secQ]</option>";
                   }
                  echo "</select>";
              ?>
              <i>Choose a security question for use if you need a password reset</i>
            </p>
            <p>
              <label>Security Answer</label>
              <input type="text" name="secA" value="" maxlength="20" id='defdd' required/>
              <i></i>
            </p>