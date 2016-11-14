<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/qs_connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$isGmailLogin = 0;
$isAdmin = 0;
$passwordHash = generatePasswordHash($password);
if (!getUserByEmail($votingDb, $email)) {
    $query = "insert into users (name, username, password, email, is_admin, isGmail) VALUES('" . $name . "','" . $username . "','" . $passwordHash . "','" . $email . "','" . $isAdmin . "','" . $isGmailLogin . "')";
    $flag = $votingDb->query($query);

    if (!$flag) {
        $output = json_encode(['flag' => false, 'message' => 'Error creating user record']);
    } else {
        $_SESSION['loggedin'] = 1;
        $output = json_encode(['flag' => true, 'message' => 'Profile create successfully']);
    }
}
else{
    $output = json_encode(['flag' => false, 'message' => 'Profile with the email already exist']);
}
echo $output;