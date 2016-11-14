<?php

include_once '../qs_connection.php';
include_once '../common/functions.php';

$name = $_POST['name'];
$password = generatePasswordHash('password');
$username = str_replace(' ','', $name);
$email = $_POST['email'];
$image_url = $_POST['image_url'];
$isGmail = 1;

if (!getUserByEmail($votingDb, $email)) {
    $query = "insert into users (name, username, password, email, is_admin, isGmail) VALUES('%s', '%s', '%s', '%s', '%s', '%s')";
    $flag = $votingDb->query(sprintf($query, $name, $username, $password, $email, 0, 1));

    if (!$flag) {
        $output = json_encode(['flag' => false, 'message' => 'Error creating user record']);
        echo $output;
        return;
    }
} else {
    $_SESSION['loggedin'] = 1;
    $query = "select * from users where email = '%s'";
    $user = $votingDb->query(sprintf($query, $email))->fetch_row();
    $_SESSION['userid'] = array_shift($user);
    $output = json_encode(['flag' => true, 'message' => 'Logged in successfully']);
    echo $output;
    return;
}
?>


