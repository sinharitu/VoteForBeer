<?php
include($_SERVER['DOCUMENT_ROOT'].'/qs_connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/common/functions.php');

$countdownDate = $_POST['settings_1'];
$maxVoteCount = $_POST['settings_2'];

$query = "select * from settings where settings_name = '%s'";
$result = $votingDb->query(sprintf($query, 'countdown'))->fetch_row();

if($result){
    $id = array_shift($result);
    $queryUpdate= "update settings set value = '%s' where id = %d";
    $flag1 = $votingDb->query(sprintf($queryUpdate, $countdownDate,$id));
}else{
    $setting_name = 'countdown';
    $queryInsert = "insert into settings (settings_name, value) VALUES ('%s', '%s')";
    $flag1 = $votingDb->query(sprintf($queryInsert, $setting_name,$countdownDate));
}
$result = $votingDb->query(sprintf($query, 'maximumCount'))->fetch_row();

if($result){
    $id = array_shift($result);
    $query = "update settings set value = '%s' where id = %d";
    $flag2 = $votingDb->query(sprintf($query, $maxVoteCount,$id));
}
else{
    $setting_name = 'maximumCount';
    $query = "insert into settings (settings_name, value) VALUES ('%s', '%s')";
    $flag2 = $votingDb->query(sprintf($query, $setting_name,$maxVoteCount));
}

if(!$flag1 || !$flag2)
{
    throw new Exception('Records not updated');
}

header('Location: '.getSite().'admin');