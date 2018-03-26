<?php 
include('session.php');
include('SQLFunctions.php');
$title = "View Deleted Deficiencies";
$link = f_sqlConnect();
$CDL = file_get_contents("CDListClosed.sql");
$Role = $_SESSION['Role'];
include('filestart.php');
?>
    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Deficiencies</h1>
        </div>
    </div>
    <div class="container">
<?php     
    if($result = mysqli_query($link,$CDL)) {
        echo "<p style='color:black'>Click Deficiency ID Number to see full details</p>
            <table width='98%' class='deftable' border='1'>
                <tr class='svbxtr'>
                    <th class='svbxth'>Def ID</th>
                    <th class='col_2  col_3  col_4 svbxth'>Location</th>
                    <th class='col_3  col_4 svbxth'>Severity</th>
                    <th class='col_1  col_2  col_3  col_4 svbxth'>Date Created</th>
                    <th class='svbxth'>Status</th>
                    <th class='col_2  col_3  col_4 svbxth'>System Affected</th>
                    <th class='svbxth'>Brief Description</th>";
                    if($Role == 'S' OR $Role == 'A' OR $Role == 'U') 
                    {
                        echo "
                            <th class='col_1  col_2  col_3  col_4 svbxth'>Last Updated</th>
                            <th class='svbxth'>Edit</th>";
                    } else {
                        echo "
                            </tr>";
                            }
                            if($Role == 'S')
                            {
                            echo "
                                <th class='svbxth'>Delete</th>
                            </tr>"; 
                    }
            while($row = mysqli_fetch_array($result)) {
                echo "  <tr class='svbxtr'>
                        <td class='svbxtd' style='text-align:center'><a href='ViewDef.php?DefID={$row[0]}' class='class1'>{$row[0]}</a></td>
                        <td class='col_2  col_3  col_4 svbxtd'>{$row[1]}</td>
                        <td class='col_3  col_4 svbxtd' style='text-align:center'>{$row[2]}</td>
                        <td class='col_1  col_2  col_3  col_4 svbxtd' style='text-align:center'>{$row[3]}</td>
                        <td class='svbxtd' style='text-align:center'>{$row[4]}</td>
                        <td class='col_2  col_3  col_4 svbxtd'>{$row[5]}</td>
                        <td class='svbxtd'>"; echo nl2br($row[6]);
                        echo "</td>";
                        if($Role == 'S' OR $Role == 'A' OR $Role == 'U') 
                        {
                            echo "
                            <td class='col_1  col_2  col_3  col_4 svbxtd'>{$row[7]}</td>
                            <td class='svbxtd' style='text-align:center'><form action='UpdateDef.php' method='POST' onsubmit=''/>
                            <input type='hidden' name='q' value='".$row[0]."'/><input type='submit' value='Update'></form></td>";
                        } else {
                        echo "</tr>";
                            }
                            if($Role == 'S')
                            {
                            echo "
                            <td class='svbxtd' style='text-align:center'><form action='DeleteDef.php' method='POST' onsubmit='' onclick='return confirm(`ARE YOU SURE? Deficiencies should not be deleted, your deletion will be logged.`)'/>
                            <input type='hidden' name='q' value='".$row[0]."' /><input type='Submit' value='delete'></form></td>
                            </tr>";
                        }
            }
                echo "
                </table>
                </div>";
    }
//mysqli_free_result($result);

    if(mysqli_error( $link )) {
        echo '<br>Error: ' .mysqli_error($link);
    }
                    
mysqli_close($link);
    
include 'fileend.php';
?>