<?php
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/..';
require_once "$baseDir/vendor/autoload.php";
// require_once 'sqlFunctions.php';
require 'session.php';

$_SESSION['timeout'] = time();

try {
    // set default redirect location to login page
    $redirectUrl = '/login.php';
    
    if (!empty($_SESSION['username']))
        throw new Exception('User is already logged in');
    if (empty($_POST['username']) || !ctype_alnum($_POST['username']))
        throw new Exception('Please enter a valid username');
    if (empty($_POST['password']) || strlen($_POST['password']) < 4)
        throw new Exception('Please enter a valid password');
    if (strlen($_POST['username']) < 4 || strlen($_POST['username']) > 20)
        throw new UnexpectedValueException('Username must be between four and twenty characters');
    if (!$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS))
        throw new UnexpectedValueException('Please enter a valid username');
    if (!$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS))
        throw new UnexpectedValueException('Please enter a valid password');

    $fields = [
        'userID',
        'username',
        'firstname',
        'lastname',
        'password',
        'role',
        'inspector',
        'secQ'
    ];

    $link = connect();
    $link->where('username', $username);

    if (!$result = $link->getOne('users', $fields))
        throw new mysqli_sql_exception("User does not exist");

    $auth = password_verify($password, $result['password']);

    if ($auth) {
        // Set session variables
        $_SESSION['userID'] = $result['userID'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['inspector'] = $result['inspector'];
        $_SESSION['timeout'] = time();

        $link->where('username', $result['username']);
        $link->update('users', ['lastLogin' => 'NOW()']);

        // if (!$result['secQ']) $redirectUrl = '/setSQ.php';
        $redirectUrl = '/dashboard.php';
    } else throw new UnexpectedValueException("Incorrect password");
} catch (UnexpectedValueException $e) {
    $_SESSION['errorMsg'] = "There was a problem with the credentials you provided: {$e->getMessage()}";
} catch (mysqli_sql_exception $e) {
    $_SESSION['errorMsg'] = "There was a problem retrieving from the database: {$e->getMessage()}";
} catch (Exception $e) {
    $_SESSION['errorMsg'] = "There was a problem with login: {$e->getMessage()}";
} finally {
    if (is_a($link->disconnect(), 'MysqliDb')) $link->disconnect();
    header("Location: $redirectUrl");
}
