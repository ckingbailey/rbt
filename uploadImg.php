<?php
session_start();

include 'nimrod.php';
include 'error_handling/uploadException.php';

$types = [ 'jpg', 'jpeg', 'png', 'gif'];

function boolToStr($bool) {
    return ($bool ? 'true' : 'false');
}

function filetypeCheck($type) {
    global $types;
    return (array_search($type, $types) !== false);
}

function mimetypeCheck($mimetype) {
    if (strpos($mimetype, 'image/') !== false) {
        // extract type info from MIME string
        $type = substr($mimetype, strpos($mimetype, '/') + 1);
        return filetypeCheck($type);
    } else return false;
}

function saveImgToServer($file, $assocID = null) {
    // check for errors
    if (!$file['error']) {
        // if assocID given, make it eleven figures long to match length of MySQL int(11)
        if ($assocID) {
            $assocID = '_'.str_pad($assocID, 11 - strlen($assocID), '0', STR_PAD_LEFT);
        }
        // validate image
        if ($filename = basename($file['name'])) {
            // if current uploaded img has same name as the last one, reject it
            if ($_SESSION['lastUploadedImg'] && $_SESSION['lastUploadedImg'] === $filename) {
                echo "Uploaded image $filename has same name as previously uploaded image {$_SESSION['lastUploadedImg']}.\n"
                    ."Please choose a new image before attempting to upload again.";
                exit;
            }
            $tmpName = $file['tmp_name'];
            // name new file for username, any associated ID, and timestamp
            $targetFilename = substr($_SESSION['Username'], 0, 6).$assocID.'_'.time();
            $targetDir = '/img_uploads';
            $targetTmpDir = '/img_tmp';
            $targetTmpPath = $targetDir.$targetTmpDir.'/'.$targetFilename.'_tmp';
            $targetLocalPath = $targetDir.'/'.$targetFilename;
            // checking MIME type depends on browser. Remove this check until and unless a more reliable MIME check is found
            // if ($fileIsImg = mimetypeCheck($file['type'])) {
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            //     echo "<h1>{$_SESSION['Username']}, {$_SESSION['UserID']}, {$_SESSION['Role']}</h1>";
            //     echo "<h4 style='color: darkMagenta'><i>MIME type:</i> {$fileIsImg}, {$file['type']}</h4>";
            // } else {
            //     echo "File did not pass MIME type check: ".$file['type'];
            //     exit; }
            if ($fileIsImg = filetypeCheck($ext)) {
                // append file extension to target temp path
                $targetTmpPath .= '.'.$ext;
                echo "<h4 style='color: mediumBlue'><i>file extension:</i>$ext, ".boolToStr($fileIsImg)."</h4>";
            } else {
                echo "File did not pass extension type check: $ext, ".boolToStr($fileIsImg);
                exit;
            } if ($tmpName && $uploadImgData = getimagesize($tmpName)) {
                echo "<h4 style='color: forestGreen'><i>file info:</i> {$uploadImgData[3]}, {$uploadImgData['mime']}</h4>";
            } else {
                echo "File $tmpName did not pass getimagesize test";
                exit;
            }
            // if image is valid, move it to temporary destination before resizing
            if ($fileIsImg = move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'].$targetTmpPath)) {
                // if move is successful, prepare filepath target string
                $targetLocalPath .= '.'.$ext;
                echo "
                    <h4 style='color: slateBlue'><i>File moved:</i> {$tmpName} -> {$_SERVER['DOCUMENT_ROOT']}{$targetTmpPath}</h4>";
                    // <img src='{$targetLocalPath}'>
            } else {
                echo "Could not move file $tmpName -> $targetTmpPath";
            }
            /*
             * @param  $file - file name to resize
             * @param  $string - The image data, as a string
             * @param  $width - new image width
             * @param  $height - new image height
             * @param  $proportional - keep image proportional, default is no
             * @param  $output - name of the new file (include path if needed)
             * @param  $delete_original - if true the original image will be deleted
             * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
             * @param  $quality - enter 1-100 (100 is best quality) default is 100
             * @return boolean|resource
             */
     
            // resize img to 320px max
            list($cur_w, $cur_h) = $uploadImgData;
            $r = $cur_w/$cur_h;
            $max_dim = 320;
            if ($cur_w >= $cur_h) {
                $new_w = $max_dim;
                $scale = $cur_w / 320;
                $new_h = $cur_h * $scale;
            } else {
                $new_h = $max_dim;
                $scale = $cur_h / 320;
                $new_w = $cur_w * scale;
            }
    
            if ($imgResized = smart_resize_image(
                $_SERVER['DOCUMENT_ROOT'].$targetTmpPath,
                null,
                $new_w,
                $new_h,
                true,
                $_SERVER['DOCUMENT_ROOT'].$targetLocalPath
            )) {
                echo "
                    <h4 style='color: paleVioletRed'>".boolToStr($imgResized)."{$_SERVER['DOCUMENT_ROOT']}$targetLocalPath}</h4>
                    <img src='$targetLocalPath'>";
                // store prev system filename only after successful upload
                $_SESSION['lastUploadedImg'] = $filename;
                return $targetLocalPath;
            } else {
                echo "<h4 style='color: saddleBrown'>There was a problem resizing the image ".boolToStr($imgResized)."</h4>";
            }
        } else echo "Could not retrieve file name $filename";
    } else {
        throw new uploadException($file['error']);
        exit;
    }
}
?>
