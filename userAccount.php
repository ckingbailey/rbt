<?php
    include('session.php');
    $role = $_SESSION['Role'];
    $username = $_SESSION['Username'];
    if ($role == 'S') $roleT = 'Super Admin';
    elseif ($role == 'A') $roleT = 'Admin';
    elseif ($role == 'U') $roleT = 'User';
    elseif ($role == 'V') $roleT = 'Viewer';
    else $roleT = '';
    echo '
        <header class="container page-header">
            <h1 class="page-title">'.$username.'</h1>
            <h3 class="text-secondary user-role-title">'.$roleT.'</h3>
        </header>
    ';
?>
<?php
    include('filestart.php');
    // display user update options for all user types
    echo '
        <main class="container main-content">
            <div class="card user-menu grey-bg">
                <ul class="card-body user-menu-list">
                    <li class="user-menu-item"><a href="UpdateProfile.php" class="card-link">Update Profile</a></li>
                    <li class="user-menu-item"><a href="UpdatePassword.php" class="card-link">Change Password</a></li>
                </ul>
            </div>
    ';
    if($role == 'A' OR $role == 'S') {
    // display admin functions for Admin and Superadmins
        echo '
            <div class="card user-menu grey-bg">
                <ul class="card-body user-menu-list">
                    <li class="user-menu-item"><a href="NewUser.php" class="card-link">Add User</a></li>
                    <li class="user-menu-item"><a href="NewLocation.php" class="card-link">Add Location</a></li>
                    <li class="user-menu-item"><a href="NewSystem.php" class="card-link">Add System</a></li>
                </ul>
            </div>
        ';
        if ($role == 'S') {
        // display Superadmin fcns only for Superadmins
            echo '
                <div class="card user-menu grey-bg">
                    <ul class="card-body user-menu-list">
                        <li class="user-menu-item"><a href="DisplayUsers.php" class="card-link">View Users List</a></li>
                        <li class="user-menu-item"><a href="DisplayEviType.php" class="card-link">View Evidence Type</a></li>
                        <li class="user-menu-item"><a href="NewEvidence.php" class="card-link">Add Evidence Type</a></li>
                        <li class="user-menu-item"><a href="NewSeverity.php" class="card-link">Add Severity Type</a></li>
                        <li class="user-menu-item"><a href="NewStatus.php" class="card-link">Add Status Type</a></li>
                    </ul>
                </div>
                <div class="center-content"><a href="logout.php" class="btn btn-primary btn-lg">Logout</a></div>
                </main>
            ';
        } else echo '
            <div class="center-content"><a href="logout.php" class="btn btn-primary btn-lg">Logout</a></div></main>
        ';
    }
    else echo '</main>';
    include('fileend.php');
?>