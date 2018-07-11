<?php
require_once 'vendor/autoload.php';
require_once('SQLFunctions.php');

session_start();

/* Check if the user is already logged in */
if (isset( $_SESSION['userID'] ))
    $message = 'User is already logged in';
/* Check that username and password are populated */
elseif (!isset($_POST['username'], $_POST['password']))
    $message = 'Please enter a valid username and password';
/* Check username length */
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
    $message = 'Incorrect Length for Username';
/* Check password length */
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
    $message = 'Incorrect Length for Password';
/* Check username for alpha numeric characters */
elseif (ctype_alnum($_POST['username']) != true)
    $message = "Username must be alpha numeric";
/* Check password for alpha numeric characters */
elseif (ctype_alnum($_POST['password']) != true)
    $message = "Password must be alpha numeric";
else $message = '';

if ($message) {
    header('Location: login.php');
    $_SESSION['errorMsg'] = $message;
    exit;
}

try {
    // set location to login page by default
    $redirectUrl = 'login.php';

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

    if (!$result = $link->getOne('users_enc', $fields))
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
        $link->update('users_enc', ['lastLogin' => 'NOW()']);

        if (!$result['secQ']) $redirectUrl = 'setSQ.php';
        else $redirectUrl = 'dashboard.php';
    } else throw new UnexpectedValueException("Incorrect password");
} catch (UnexpectedValueException $e) {
    $_SESSION['errorMsg'] = "There was a problem with the credentials you provided: {$e->getMessage()}";
} catch (mysqli_sql_exception $e) {
    $_SESSION['errorMsg'] = "There was a problem retrieving from the database: {$e->getMessage()}";
} catch (Exception $e) {
    $_SESSION['errorMsg'] = "There was a problem with login: {$e->getMessage()}";
} finally {
    header("Location: $redirectUrl");
    $link->disconnect();
    exit;
}
