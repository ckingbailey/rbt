<?php
/* @param $argv[1] = username
** @param $argv[2] = password
*/
$rootDir = getenv("HOME");

/* find project root and autoload vendor/
** if executing in c9, append /workspace to project path
*/
$projectDir = (getenv("C9_HOSTNAME") && (strpos(getenv("C9_HOSTNAME"), 'c9') !== false))
    ? $rootDir . '/workspace'
    : $rootDir;
require "$projectDir/vendor/autoload.php";
require $projectDir . '/config.php';

try {
    if ($argc < 3) {
        $argsNum = $argc - 1;
        throw new InvalidArgumentException("add_user requires two arguments: username and password. $argsNum found.");
    }
    if (!$username = filter_var($argv[1], FILTER_SANITIZE_STRING))
        throw new InvalidArgumentException("Unable to retrieve username");
    if (!$password = password_hash(filter_var($argv[2], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT))
        throw new InvalidArgumentException("Unable to retrieve password");
} catch (Exception $e) {
    fwrite(STDOUT, "\33[33m{$e->getMessage()} \33[0m\n");
    exit;
}

try {
    $link = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);

    $userID = $link->insert('users', [
        'username' => $username,
        'password' => $password,
        'role' => 40,
        'dateAdded' => 'NOW()'
    ]);
    
    if (!$userID) {
        throw new Exception("There was a problem inserting new user: {$link->getLastError()}");
    }
    else fwrite(STDOUT, "\33[32mNew user ID: $userID\33[0m\n");
} catch (Exception $e) {
    fwrite(STDOUT, "\33[33m{$e->getMessage()} \33[0m\n");
} finally {
    $link->disconnect();
    exit;
}
