<?php
include 'session.php';
include 'SQLFunctions.php';

$title = 'SVBX - Inspectors\' Daily Reports';
$userID = $_SESSION['userID'];
$role = $_SESSION['role'];

$qry = "SELECT userid, username, firstname, lastname, viewidr FROM users_enc where userid='$userID'";

if ($_SESSION['inspector']) {
    $idrAuth = $role;
} else {
    $idrAuth = 0;
}

$qry = "SELECT idrID, i.userID, idrForDate, username FROM IDR i JOIN users_enc u on i.UserID=u.UserID";
$orderBy = " ORDER BY idrID DESC";

$errorMsg = [
    'myIDRs' => 'Unable to retrieve reports for user',
    'idrList' => 'There was a problem retrieving report list'
];

// check if non-admin user has own IDRs
try {
    $link = f_sqlConnect();
    if ($myIDRs = $link->query("$qry WHERE i.UserID='$userID'$orderBy")) {
        // if auth level > 1 OR user has own IDRs, grant permission
        $idrAuth = ($idrAuth > 10 || $myIDRs->num_rows) ? $idrAuth : 0;
    }
    if ($link->error) throw new mysqli_sql_exception($link->error);
} catch (Exception $e) {
    echo "Unable to retrieve your daily reports";
} finally {
    $link->close();
}

if ($idrAuth) {
    include 'filestart.php';
    $link = f_sqlConnect();
    echo "
        <header class='container page-header'>
            <h1 class='page-title'>Inspectors' Daily Reports</h1>
        </header>
        <main class='container main-content'>
            <div class='row'>
                <div class='col-sm-10 col-md-6 offset-sm-1 offset-md-3'>
                    <div class='card no-border-radius box-shadow'>
                        <div class='card-body pad-more'>
                            <ul class='nav nav-tabs no-border flex-row flex-nowrap justify-content-center' role='tablist'>";
                                $active = ' active';
                                $expanded = " aria-expanded='true'";
                                if ($idrAuth > 10) {
                                    echo "
                                        <li class='item-margin-right-less' role='presentation'>
                                            <a href='#allReports' aria-controls='allReports'{$expanded} role='tab' data-toggle='tab' class='h4 pl-3 pb-3 pr-3 border-dark-blue{$active}'>All Reports</a>
                                        </li>";
                                    $active = '';
                                    $expanded = '';
                                }
                                // render My IDRs button only if user has IDRs of their own
                                if ($myIDRs->num_rows) {
                                    echo "
                                        <li class='item-margin-right-less' role='presentation'>
                                            <a href='#myReports' aria-controls='myReports'{$expanded} role='tab' data-toggle='tab' class='h4 pl-3 pb-3 pr-3 border-dark-blue{$active}'>My Reports</a>
                                        </li>";
                                }
    echo "
                            </ul>
                            <div class='tab-content mt-3 thick-grey-line'>";
                                // if user is admin or super, query for all IDRs
                                $active = ' active';
                                if ($role >= 30) {
                                    if ($result = $link->query($qry.$orderBy)) {
                                        if ($result->num_rows) {
                                            echo "
                                                <div role='tabpanel' id='allReports' class='tab-pane pt-1 pl-2 pr-2 fit-content center-element{$active}'>
                                                    <ul class='pl-0'>";
                                            while ($row = $result->fetch_assoc()) {
                                                printf(
                                                    "<li class='item-margin-bottom-less'>
                                                        <a href='%s'>%s <span class='text-secondary font-italic'>&bull; %s</span></a>
                                                    </li>",
                                                    "/idr.php?idrID={$row['idrID']}",
                                                    $row['idrForDate'],
                                                    $row['username']
                                                );
                                            }
                                            echo "
                                                    </ul>
                                                </div>";
                                            $active = '';
                                        } else echo "<h4>That's strange. No reports were found. I suspect something's up.</h4>";
                                        $result->close();
                                    } elseif ($link->error) {
                                        echo "
                                            <h4 id='error-msg-idrList' class='error-msg text-red'>{$errorMsg['idrList']}</h4>
                                            <h5 id='error-msg-{$link->errno}' class='error-msg text-secondary'>{$link->error}</h5>";
                                        return;
                                    }
                                }
                                // if user has an IDRs of their own render them under My IDRs tab
                                if ($myIDRs) {
                                    if ($myIDRs === $errorMsg['myIDRs']) {
                                        echo "
                                            <h4 id='error-msg-myIDRs' class='text-red'>{$errorMsg['myIDRs']}</h4>";
                                        return;
                                    }
                                    elseif ($myIDRs->num_rows) {
                                        echo "
                                            <div role='tabpanel' id='myReports' class='tab-pane pt-1 pl-2 pr-2 fit-content center-element{$active}'>
                                                <ul class='pl-0'>";
                                                while ($row = $myIDRs->fetch_assoc()) {
                                                    printf(
                                                        "<li class='item-margin-bottom-less'>
                                                            <a href='%s'>%s</a>
                                                        </li>",
                                                        "/idr.php?idrID={$row['idrID']}",
                                                        $row['idrForDate']
                                                    );
                                                }
                                        echo "
                                                </ul>
                                            </div>";
                                        $myIDRs->close();
                                    }
                                }
    echo "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>";
    include 'fileend.php';
} else {
    include "unauthorised.php";
}
?>
