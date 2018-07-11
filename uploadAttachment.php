<?php
use codeguy\Upload;
use codeguy\Upload\Exception;
require 'vendor/autoload.php';

include_once('error_handling/sqlErrors.php');

function uploadAttachment($cnxn, $key, $dir, $assocID) {
    $filetypes = explode(',',
        preg_replace('/\s+/', '', file_get_contents('allowedFormats.csv')));
    $storage = new \Upload\Storage\FileSystem($dir);
    $attachment = new \Upload\File($key, $storage);
    $filename = $attachment->getNameWithExtension();
    $filepath = $dir.'/'.$filename;
    $filesize = $attachment->getSize();
    $fileext = $attachment->getExtension();
    $attachment->addValidations($filetypes);
    $sql = 'INSERT bartdlAttachments (bdaFilepath, bartdlID, uploaded_by, filesize, fileext, filename) VALUES (?, ?, ?, ?, ?, ?)';
    $types = 'siiiss';
    try {
        $attachment->upload();
    } catch (UploadException $e) {
        http_response_code(500);
        throw new UploadException($e);
    }
    
    try {
        if (!$stmt = $cnxn->prepare($sql)) throw new mysqli_sql_exception($cnxn->error);
        if (!$stmt->bind_param($types,
            $cnxn->escape_string($filepath),
            intval($assocID),
            intval($_SESSION['userID']),
            intval($filesize),
            $cnxn->escape_string($fileext),
            $cnxn->escape_string($filename))) throw new mysqli_sql_exception($stmt->error);
        if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
        $stmt->close();
        return $filepath;
    } catch (\mysqli_sql_exception $e) {
        $stmt->close();
        http_response_code(500);
        throw new mysqli_sql_exception($e);
    } catch (\Exception $e) {
        http_response_code(500);
        throw new Exception($e);
    }
}