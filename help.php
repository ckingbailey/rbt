<?php
include('SQLFunctions.php');
session_start();


    $title = "SVBX - Help";
    $link = f_sqlConnect();
    include('filestart.php');
?>

<main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Help</h1>
                <p>If you are having difficulties with the database please contact one of the people below who have administrator rights,<br>otherwise email <a href="mailto:robert.burns@vta.org?subject=SVBX Deficiency Database Issue"  style='color:black'>Robert Burns</a> for assistance.</p>
            </div>
        </div>
        <div class="container">        
<?php
    $table = users_enc;
    
    if(!f_tableExists($link, $table, DB_Name)) {
        die('<br>Destination table does not exist: '.$table);
    }
    
    $sql = "SELECT firstname, lastname, Email FROM $table WHERE Role = 'A' OR Role = 'S' ORDER BY lastname";
   
    
    if($result = mysqli_query($link,$sql)) {
        echo"   <table class='svbxtable' style='width:45%'>
                    <tr class='svbxtr'>
                        <th class='svbxth' style='width:10%'>First name</th>
                        <th class='svbxth' style='width:10%'>Last name</th>
                        <th class='svbxth' style='width:25%'>Email</th>
                    </tr>"; 
                    while ($row = mysqli_fetch_array($result)) {
                    echo "       
                    <tr class='svbxtr'>
                        <td class='svbxtd'>{$row[0]}</td>
                        <td class='svbxtd'>{$row[1]}</td>
                        <td class='svbxtd'><a href='mailto:{$row[2]}' style='color:black'>{$row[2]}</a></td>
                    </tr>";
                    }
    }
            echo "</table><br></div>";
    mysqli_free_result($result);
    
    if(mysqli_error($link)) {
        echo '<br>Error: ' .mysqli_error($link);
    } else //echo '<br>Success';
    
    mysqli_close($link);
    include('fileend.php') 
?>