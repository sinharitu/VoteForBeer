<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/qs_connection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');
//$returnVal= uploadFile($_FILES["fileToUpload"]);

$returnVal['flag'] = true;
$returnVal['image_url'] = null;
$name = $_POST['beerName'];
$description = $_POST['beerDescription'];

if (!$returnVal['flag']) {

    throw new Exception($returnVal['errorMessage']);
} else {
    if ($_POST['beer_id']) {
        $query = "update beers set name='%s', description ='%s' where id=%d";
        $updatedQuery = sprintf($query,$name, $description,  $_POST['beer_id']);
    } else {
        $query = "insert into beers (name, description) VALUES ('%s', '%s')";
        $updatedQuery = sprintf($query,$name, $description);
    }
}

$bFlag = $votingDb->query($updatedQuery);
if (!$bFlag) {
    die('could not update the record');
}

header('Location: ' . getSite() . 'admin');

?>
