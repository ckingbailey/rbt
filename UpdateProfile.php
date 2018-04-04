<?php 
    include('session.php');
    include('SQLFunctions.php');
    $link = f_sqlConnect();
    $table = users_enc;
    $q = $_SESSION['UserID'];
    $title = "SVBX - Update Profile";
    $Loc = "SELECT Username, Role, firstname, lastname, Email, Company, SecQ, SecA FROM $table WHERE UserID = ".$q;
    include('filestart.php');
    
    $sql1 = "SELECT SecQID, SecQ FROM secQ ORDER BY SecQID";
    $list1 = mysqli_query($link,$sql1);
?>
        <header class="container page-header">
            <h1 class="page-title">Update User Information</h1>
        </header>
<?php       if($stmt = $link->prepare($Loc)) {
            $stmt->execute();
            $stmt->bind_result($Username, $Role, $firstname, $lastname, $Email, $Company, $SecQ, $SecA);
            while ($stmt->fetch()) {
                echo "
                    <div class='container main-content'>
                        <FORM action='UpdateProfileCommit.php' method='POST' onsubmit='' />
                            <input type='hidden' name='UserID' value='".$q."'>
                            <table class='table'>
                                <tr class='usertr'>
                                    <th class='userth'>First name:</td>
                                    <td class='usertd'>
                                        <input type='text' name='firstname' maxlength='25' required value='".$firstname."'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Last name:</td>
                                    <td class='usertd'>
                                        <input type='text' name='lastname' maxlength='25' required value='".$lastname."'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Email Address:</td>
                                    <td class='usertd'>
                                        <input type='text' name='Email' maxlength='55' required value='".$Email."'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Username:</td>
                                    <td class='usertd'>
                                        <input type='text' name='Username' maxlength='25' required value='".$Username."'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Company:</td>
                                    <td class='usertd'>
                                        <input type='text' name='Company' maxlength='25' required value='".$Company."'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Update Security Question:</td>
                                    <td class='usertd'><select name='SecQ' value='".$SecQ."' id='defdd' style='min-width: 400px'></option>
                                        <option value=''></option>";
                                        if(is_array($list1) || is_object($list1)) {
                                        foreach($list1 as $row) {
                                            echo "<option value='$row[SecQID]'";
                                                if($row[SecQID] == $SecQ) {
                                                    echo " selected>$row[SecQ]</option>";
                                                    } else { echo ">$row[SecQ]</option>";
                                                }
                                        }
                                        }
                                echo "
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Update Security Answer:</td>
                                    <td class='usertd'>
                                        <input type='text' name='SecA' maxlength='25' required value='".$SecA."'/>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Password:</td>
                                    <td class='usertd'>
                                        <input type='password' name='Password' maxlength='25' value=''/><br />
                                        <i>only complete if you want to change a users password</i>
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <th class='userth'>Confirm Password:</td>
                                    <td class='usertd'>
                                        <input type='password' name='ConPwd' maxlength='25' value=''/><br />
                                        <i>confirm new password</i>
                                    </td>
                                </tr>";
                                if($ARole == 'S') {
                                echo "
                                <tr class='usertr'>
                                    <th class='userth' rowspan='4'>Role:</td>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='S'"; 
                                        if($ARole== 'S') { 
                                        echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>Super Admin
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='A'"; 
                                        if($Role== 'A') { 
                                            echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>Administrator
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='U'"; 
                                        if($Role== 'U') { 
                                            echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>User
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='V'"; 
                                        if($Role== 'V') { 
                                            echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>Read Only
                                    </td>
                                </tr>";
                                } elseif($ARole == 'A') {
                                echo "
                                <tr class='usertr'>
                                    <th class='userth' rowspan='3'>Role:</td>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='A'"; 
                                        if($Role== 'A') { 
                                        echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>Administrator
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='U'"; 
                                        if($Role== 'U') { 
                                            echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>User
                                    </td>
                                </tr>
                                <tr class='usertr'>
                                    <td class='usertd'>
                                        <input type='radio' name='Role' value='V'"; 
                                        if($Role== 'V') { 
                                            echo ' checked'; 
                                        } else { 
                                        }
                                        echo "/>Read Only
                                    </td>
                                </tr>";
                                } else {
                                }
                                echo "
                                </table>
                                <input type='submit' value='submit' class='btn btn-primary btn-lg'/>
                                <input type='reset' value='reset' class='btn btn-primary btn-lg' />
                            </FORM>";
                        }
                        echo "</div>";
                    } else {
                    echo '<br>Unable to connect';
                    echo '<br />SQL: '.$Loc;
                    echo '<br />UserID: '.$q;
                    exit();
                }
        include('fileend.php') ?>