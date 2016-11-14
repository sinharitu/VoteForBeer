<?php
include($_SERVER['DOCUMENT_ROOT'] . '/common/header.php');
$beer_id= $_POST['selectedbeerId'];
$flag = deleteBeerById($votingDb, $beer_id);

header('Location: '. getBaseUrl());