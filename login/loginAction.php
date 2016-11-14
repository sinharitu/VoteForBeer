<?php
include_once '../qs_connection.php';
include_once '../common/functions.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "select * from users where username = '%s'";
$result = $votingDb->query(sprintf($query, $username))->fetch_row();

$passwordHash = $result[3];
$flag = password_verify($password, $passwordHash);

if ($flag) {
    if (sizeof($result) > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $result[0];
        $_SESSION['isAdmin'] = $result[5];
        if ($result[5]) {
            header('Location: ' . getSite() . 'admin');
        } else {
            header('Location: ' . getSite() . 'vote');
        }
    }
} else {
    throw new Exception('Username and password combination is not right');
}

