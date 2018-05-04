<?php
    include 'session.php';
    include 'SQLFunctions.php';
    
    $role = $_SESSION['Role'];
    $userID = $_SESSION['UserID'];
    $username = $_SESSION['Username'];
    $link = f_sqlConnect();
    
    // user data
    $userQry = "SELECT firstname, lastname, viewIDR FROM users_enc WHERE UserID='$userID'";
    $idrQry = "SELECT COUNT(idrID) FROM IDR WHERE UserID='$userID'";
    
    if ($result = $link->query($userQry)) {
        $row = $result->fetch_assoc();
        $userFullName = $row['firstname'].' '.$row['lastname'];
        $authLvl = [
            'V' => 0,
            'U' => 1,
            'A' => 2,
            'S' => 3
        ];
        $idrAuth = $row['viewIDR'] ? $authLvl[$role] : $row['viewIDR'];
        $result->close();
    } elseif ($link->error) {
        $userFullName = 'Unable to retrieve user account information';
        $idrAuth = 0;
    }
    
    // check for IDRs submitted by current user
    if ($result = $link->query($idrQry)) {
        $row = $result->fetch_row();
        $myIDRs = $idrAuth && $row[0];
        $result->close();
    }
    
    
    
    $roleT = [
        'S' => 'Super Admin',
        'A' => 'Admin',
        'U' => 'User',
        'V' => 'Viewer'
    ];
    
    // auth-level-specific views
    $userLinks = [
        'views' => [ 'idrList' => "My Inspectors' Daily Reports" ]
    ];
    $adminLinks = [
        'views' => [ 'idrList' => "All Inspectors' Daily Reports" ],
        'forms' => [
            'NewUser' => 'Add new user',
            'NewLocation' => 'Add new Location',
            'NewSystem' => 'Add new system'
        ]
    ];
    $superLinks = [
        'views' => [
            'DisplayUsers' => 'View user list',
            'DisplayEviType' => 'View evidence type list'
        ],
        'forms' => [
            'NewEvidence' => 'Add new evidence type',
            'NewSeverity' => 'Add new severity level',
            'NewStatus' => 'Add new status type'
        ]
    ];
?>
<?php
    include('filestart.php');
    // user account management links
    echo "
        <header class='container page-header'>
            <h1 class='page-title'>$userFullName</h1>
            <h3 class='text-secondary user-role-title'>{$roleT[$role]}</h3>
        </header>
        <main class='container main-content'>
            <div class='card item-margin-bottom no-border-radius box-shadow'>
                <div class='card-body pad-more'>
                    <h4 class='text-secondary'>Manage your account</h4>
                    <hr class='thick-grey-line' />
                    <ul class='item-margin-bottom'>
                        <li class='item-margin-bottom'><a href='UpdateProfile.php'>Update Profile</a></li>
                        <li class='item-margin-bottom'><a href='UpdatePassword.php'>Change Password</a></li>
                    </ul>
                </div>
            </div>";
            // render Data Views only if user has permission
            if ($myIDRs || $idrAuth > 1) {
                echo "
                    <div class='card item-margin-bottom no-border-radius box-shadow'>
                        <div class='card-body pad-more'>
                            <h4 class='text-secondary'>Data views</h4>
                            <hr class='thick-grey-line' />
                            <ul class='item-margin-bottom'>";
                            // data views
                            if ($myIDRs && $idrAuth <= 1) {
                                printf("<li class='item-margin-bottom'><a href='%s.php'>%s</a></li>", 'idrList', $userLinks['views']['idrList']);
                            }
                            if ($idrAuth > 1) {
                                foreach ($adminLinks['views'] as $href => $text) {
                                    printf("<li class='item-margin-bottom'><a href='%s.php'>%s</a></li>", $href, $text);
                                }
                                if ($role == 'S') {
                                    foreach ($superLinks['views'] as $href => $text) {
                                        printf("<li class='item-margin-bottom'><a href='%s.php'>%s</a></li>", $href, $text);
                                    }
                                }
                            }
                // data management links
                echo "
                            </ul>
                        </div>
                    </div>
                    <div class='card item-margin-bottom no-border-radius box-shadow'>
                        <div class='card-body pad-more'>
                            <h4 class='text-secondary'>Manage data</h4>
                            <hr class='thick-grey-line' />
                            <ul class='item-margin-bottom'>";
                            foreach ($adminLinks['forms'] as $href => $text) {
                                printf("<li class='item-margin-bottom'><a href='%s.php'>%s</a></li>", $href, $text);
                            }
                            if ($role === 'S') {
                                foreach ($superLinks['forms'] as $href => $text) {
                                    printf("<li class='item-margin-bottom'><a href='%s.php'>%s</a></li>", $href, $text);
                                }
                            }
                echo "
                            </ul>
                        </div>
                    </div>";
            }
    echo '
        <div class="center-content"><a href="logout.php" class="btn btn-primary btn-lg">Logout</a></div>
    </main>';
    include('fileend.php');
?>