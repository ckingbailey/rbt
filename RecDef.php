<?PHP
session_start();
include('SQLFunctions.php');
include('uploadImg.php');
$link = f_sqlConnect();
$date = date('Y-m-d');
$nullVal = null;
$post = $_POST;
$sql = file_get_contents("recDef.sql");

// if photo in POST it will be committed to a separate table
if ($_FILES['CDL_pics']['size']
    && $_FILES['CDL_pics']['name']
    && $_FILES['CDL_pics']['tmp_name']
    && $_FILES['CDL_pics']['type']) {
    $CDL_pics = $_FILES['CDL_pics'];
} else $CDL_pics = null;

$userID = $_SESSION['UserID'];

// echo "<p style='font-family: monospace'>SQL string: $sql</p>";
// echo "<pre style='color: blue'>";
// var_dump($post);
// echo "</pre>";

if ($stmt = $link->prepare($sql)) {
  $types = 'iiisiisiiisisssssiisssss';
  if ($stmt->bind_param($types,
    $post['SafetyCert'],
    $post['SystemAffected'],
    $post['Location'],
    $link->escape_string($post['SpecLoc']),
    $post['Status'],
    $post['Severity'],
    $link->escape_string($post['DueDate']),
    $post['GroupToResolve'],
    $post['RequiredBy'],
    $post['contractID'],
    $link->escape_string($post['IdentifiedBy']),
    $post['defType'],
    $link->escape_string($post['Description']),
    $link->escape_string($post['Spec']),
    $link->escape_string($post['ActionOwner']),
    $link->escape_string($post['OldID']),
    $link->escape_string($post['comments']),
    $post['EvidenceType'],
    $post['Repo'],
    $link->escape_string($post['EvidenceLink']),
    $link->escape_string($post['ClosureComments']),
    $link->escape_string($post['username']),
    $date,
    $nullVal
  )) {
    echo "<p style='color: lightSeaGreen; font-family: monospace'>{$stmt->param_count}</p>";
    if ($stmt->execute()) {
      $newDefID = $stmt->insert_id;
      echo "<p style='color: tomato; font-family: cursive'>AFFECTED ROWS: ";
      echo $stmt->affected_rows;
      echo "</p>";
      $stmt->close();
      // if INSERT succesful, prepare, upload, and INSERT photo
      if ($newDefID) {
        echo "<p style='color: teal'>INSERT ID: $newDefID</p>";
        // echo "<pre style='color: royalBlue'>";
        // echo var_dump($_FILES);
        // echo "</pre>";

        if ($CDL_pics) {
          $pathToFile = $link->escape_string(saveImgToServer($_FILES['CDL_pics'], $newDefID));
          $qs .= "&$pathToFile";
          $sql = "INSERT CDL_pics (defID, pathToFile) values (?, ?)";
          if ($stmt = $link->prepare($sql)) {
            echo "
              <p style='font-family: sans-serif; color: chocolate'>
              $sql<br>
              $newDefID<br>
              $pathToFile
              </p>";
              if ($stmt->bind_param('is', $newDefID, $pathToFile)) {
                echo "<p style='color: grey'>CDL_pics PARAM_CT: {$stmt->param_count}</p>";
                  if ($stmt->execute()) {
                    echo "
                      <p id='CDL_picINSERTsuccess' style='color: oliveDrab'>new CDL_pic id: {$stmt->insert_id}<br>
                      affected CDL_pic rows: {$stmt->affected_rows}</p>";
                  } else {
                    echo "<pre id='CDL_picINSERT->error' style='color: olive; font-size: 1.2rem'>";
                    echo $stmt->error;
                    echo "</pre>";
                  }
                  $stmt->close();
              } else {
                echo "<p style='color: orangeRed'>";
                echo $stmt->error;
                echo "</p>";
              }
          } else {
            echo "<p style='color: forestGreen'>";
            echo $link->error;
            echo "</p>";
            exit;
          }
        }
      }
    } elseif ($stmt->error) {
      echo "<pre style='color: mediumSlateBlue; font-size: 1.2rem'>STATEMENT ERROR: ";
      echo $stmt->error;
      echo "</pre>";
    } else {
      echo "<pre style='color: goldenRod; font-size: 1.2rem'>LINK ERROR from execute: ";
      echo $link->error;
      echo "</pre>";
    }
    // echo "<h4>did it execute? what was the result? who knows?</h4>";
  } else {
    echo "<pre style='color: limeGreen'>";
    echo $link->error;
    echo "</pre>";
    $link->close();
    exit;
  }
} else {
  echo "<pre style='color: fuchsia'>{$link->error}</pre>";
  $link->close();
  exit;
}
  
// $stmt->close();
$link->close();
	
header("Location: ViewDef.php?defID=$newDefID");
?>