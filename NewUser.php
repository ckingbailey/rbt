<?php
include('session.php');
$title = "SVBX - Add New User";
include('filestart.php');
    if($Role == 'U' OR $Role == 'V') {
        header('location: unauthorised.php');
    }
?>
        <header class="container page-header">
          <h1 class="page-title">Add New User</h1>
        </div>
        <div class="container"> 
        <form action="AddUserSubmit.php" method="post">
            <table class='table svbx-table'>
              <tr class='usertr'>
                <th class='userth'>
                  <label>First name</label>
                </th>
                <td class='usertd'>
                  <input type="text" name="firstname" value="" maxlength="25" id='defdd' required/>
                  <i>(4-25 characters)</i>
                </td>
              </tr>
              <tr class='usertr'>
                <th class='userth'>
                  <label>Last name</label>
                </td>
                <td class='usertd'>
                  <input type="text" name="lastname" value="" maxlength="25" id='defdd' required/>
                  <i>(4-25 characters)</i>
                </td>
              </tr>
              <tr class='usertr'>
                <th class='userth'>
                  <label>Company name</label>
                </td>
                <td class='usertd'>
                  <input type="text" name="Company" value="" maxlength="255" id='defdd' required/>
                </td>
              </tr>
              <tr class='usertr'>
                <th class='userth'>
                  <label>Email</label>
                </td>
                <td class='usertd'>
                  <input type="text" name="Email" value="" maxlength="55" id='defdd' required/>
                  <i>(4-55 characters)</i>
                </td>
              </tr>
              <tr class='usertr'>
                <th class='userth'>
                  <label>Username</label>
                </td>
                <td class='usertd'>
                  <input type="text" name="username" value="" maxlength="20" id='defdd' required/>
                  <i>(4-20 characters)</i>
                </td>
              </tr>
              <tr class='usertr'>
                <th class='userth'>
                  <label>Password</label>
                </td>
                <td class='usertd'>
                  <input type="password" name="pwd" value="" maxlength="20" id='defdd' required/>
                  <i>(4-20 characters)</i>
                </td>
              </tr>
            </table>
            <br />
            <input type='submit' value='submit' class='btn btn-primary btn-lg' style='margin-left:40%' />
            <input type='reset' value='reset' class='btn btn-primary btn-lg' />
        </form>
        </div>

        <?php include('fileend.php') ?>