<?php
include('session.php');
include('html_components/defComponents.php');
include('SQLFunctions.php');
include('html_functions/bootstrapGrid.php');
$link = f_sqlConnect();
$title = 'SVBX - New BART Deficiency';
$acceptFormats = preg_replace('/\s+/', ' ', file_get_contents('allowedFormats.csv'));

include('filestart.php');

if ($result = $link->query('SELECT bdPermit from users_enc where userID='.$_SESSION['UserID'])) {
    if ($row = $result->fetch_row()) {
        $bdPermit = $row[0];
    }
    $result->close();
}
if ($bdPermit) {
    $labelStr = "<label for='%s'%s>%s</label>";
    $required = " class='required'";
    
    $topRows = [
        'row1' => [
            'col1' => [
                'options' => [ 'inline' => true ],
                [ $generalElements['creator'] ],
                [ $generalElements['next_step'] ],
                [ $generalElements['bic'] ],
                [ $generalElements['status'] ]
            ],
            $generalElements['descriptive_title_vta']
        ]
    ];

    $vtaRows = [
        'row1' => [ $vtaElements['root_prob_vta'] ],
        'row2' => [ $vtaElements['resolution_vta'] ],
        'row3' => [
            'col1' => [
                'options' => [ 'inline' => true ],
                [ $vtaElements['priority_vta'] ],
                [ $vtaElements['agree_vta'] ],
                [ $vtaElements['safety_cert_vta'] ],
                [
                    'options' => [ 'inline' => true ],
                    $vtaElements['resolution_disputed'],
                    $vtaElements['structural']
                ]
            ],
            'col2' => [
                [ $vtaElements['bdCommText'] ],
                [
                    'options' => [ 'inline' => true ],
                    $vtaElements['attachment']
                ]
            ]
        ]
    ];

    $bartRows = [
        'row1' => [ $bartElements['id_bart'] ],
        'row2' => [ $bartElements['description_bart'] ],
        'row3' => [
            'options' => [ 'inline' => true ],
            'col1' => [
                [ $bartElements['cat1_bart'] ],
                [ $bartElements['cat2_bart'] ],
                [ $bartElements['cat3_bart'] ]
            ],
            'col2' => [
                [ $bartElements['level_bart'] ],
                [ $bartElements['dateOpen_bart'] ],
                [ $bartElements['dateClose_bart'] ]
            ]
        ]
    ];

    echo "
        <header class='container page-header'>
            <h1 class='page-title'>Add New Deficiency</h1>
        </header>
        <main role='main' class='container main-content'>
            <form action='recBartDef.php' method='POST' enctype='multipart/form-data'>
                <input type='hidden' name='created_by' value='{$_SESSION['UserID']}' />
                <h5 class='grey-bg pad'>General Information</h5>";
                foreach ($topRows as $gridRow) {
                    print returnRow($gridRow);
                }
    echo "
                <h5 class='grey-bg pad'>VTA Information</h5>";
                foreach ($vtaRows as $gridRow) {
                    print returnRow($gridRow);
                }
    echo "
                <h5 class='grey-bg pad'>BART Information</h5>";
                foreach ($bartRows as $gridRow) {
                    print returnRow($gridRow);
                }
    echo "
                <div class='center-content'>
                    <button type='submit' class='btn btn-primary btn-lg'>Submit</button>
                    <button type='reset' class='btn btn-primary btn-lg'>Reset</button>
                </div>
            </form>
        </main>";
} else {
    header('Location: unauthorised.php');
    exit;
}

$link->close();
include('fileend.php');
