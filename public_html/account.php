<?php
    $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
    require 'session.php';
    require_once $baseDir . '/vendor/autoload.php';
    include 'sql_functions/sqlFunctions.php';
    
    // init Twig
    $loader = new Twig_Loader_Filesystem("$baseDir/templates");
    $twig = new Twig_Environment($loader,
        [
            'debug' => true
        ]
    );
    $twig->addExtension(new Twig_Extension_Debug());

    $role = $_SESSION['role'];
    $userID = $_SESSION['userID'];
    $username = $_SESSION['username'];
    $link = f_sqlConnect();

    // user data
    $idrQry = "SELECT COUNT(idrID) FROM IDR WHERE UserID='$userID'";

    $userFullName = !empty($_SESSION['username'])
        ? ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])
            ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname']
            : $_SESSION['username'] )
        : '';
    $navbarHeading = $userFullName;
    $idrAuth = $_SESSION['inspector'] ? $role : 0;

    // check for IDRs submitted by current user
    if ($result = $link->query($idrQry)) {
        $row = $result->fetch_row();
        $myIDRs = $idrAuth ? $row[0] : null;
        $result->close();
    }

    $roleT = [
        40 => 'Super Admin',
        30 => 'Admin',
        20 => 'User',
        15 => 'Contractor',
        10 => 'Viewer'
    ];

    // auth-level-specific views
    $userLinks = [
        'views' => [ 'idrList' => "My Inspectors' Daily Reports" ]
    ];
    $adminLinks = [
        'views' => [ 'idrList' => "All Inspectors' Daily Reports" ],
        'forms' => [
            'newUser' => 'Add new user',
            'NewLocation' => 'Add new Location',
            'NewSystem' => 'Add new system'
        ]
    ];
    $superLinks = [
        'views' => [
            'displayUsers' => 'View user list',
            'DisplayEviType' => 'View evidence type list'
        ],
        'forms' => [
            'NewEvidence' => 'Add new evidence type',
            'NewSeverity' => 'Add new severity level',
            'NewStatus' => 'Add new status type'
        ]
    ];

    $title = PROJECT_NAME . ' - My Account';
    // include('filestart.php');
    // user account management links
    $twig->display('head.html.twig', [ 'title' => PROJECT_NAME . ' - My account']);
    
    echo "<body>";
    
    $twig->display('nav.html.twig', [ 'navbarHeading' => $navbarHeading ]);
    
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
            if ($role >= 30) {
                echo "
                    <div class='card item-margin-bottom no-border-radius box-shadow'>
                        <div class='card-body pad-more'>
                            <h4 class='text-secondary'>Manage data</h4>
                            <hr class='thick-grey-line' />
                            <ul class='item-margin-bottom'>";
                            if ($role >= 40) {
                                printf("<li class='item-margin-bottom'><a href='%s.php'>%s</a></li>", '/manage', 'Data views');
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
    exit;