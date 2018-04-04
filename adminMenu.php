<?php
    function adminMenu($usertype) {
        echo '
            <ul class="user-menu admin-menu">
                <li><a href="NewUser.php">Add User</a></li>
                <li><a href="NewLocation.php">Add Location</a></li>
                <li><a href="NewSystem.php">Add System</a></li>
            </ul>
        ';
        if ($usertype == 'S') {
            echo '
                <ul class="user-menu superadmin-menu">
                    <li><a href="NewEvidence.php">Add Evidence Type</a></li>
                    <li><a href="NewSeverity.php">Add Severity Type</a></li>
                    <li><a href="NewStatus.php">Add Status Type</a></li>
                </ul>
                </main>
            ';
        } else echo '</main>';
    }
  ?>