<?php

function countdown($time, $h = true, $m = true, $s = true)
{

    $rem = date_create($time) - time();

    $day = floor($rem / 86400);
    $hr = floor(($rem % 86400) / 3600);
    $min = floor(($rem % 3600) / 60);
    $sec = ($rem % 60);

    if ($day && !$h) {
        if ($hr > 12) {
            $day++;
        } // round up if not displaying hours
    }

    $ret = Array();
    if ($day && $h) {
        $ret[] = ($day ? $day . " day" . ($day == 1 ? "" : "s") : "");
    }
    if ($day && !$h) {
        $ret[] = ($day ? $day . " day" . ($day == 1 ? "" : "s") : "");
    }
    if ($hr && $h) {
        $ret[] = ($hr ? $hr . " hour" . ($hr == 1 ? "" : "s") : "");
    }
    if ($min && $m && $h) {
        $ret[] = ($min ? $min . " minute" . ($min == 1 ? "" : "s") : "");
    }
    if ($sec && $s && $m && $h) {
        $ret[] = ($sec ? $sec . " second" . ($sec == 1 ? "" : "s") : "");
    }

    $last = end($ret);
    array_pop($ret);
    $string = join(", ", $ret) . " and {$last}";

    return $string;
}

function uploadFile($file)
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $errorMessage = '';

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = true;
    } else {
        $errorMessage = "File is not an image.";
        $uploadOk = false;
    }
    if (file_exists($target_file)) {
        $errorMessage = "Sorry, file already exists.";
        $uploadOk = false;
    }
    if ($file["size"] > 500000) {
        $errorMessage = "Sorry, your file is too large.";
        $uploadOk = false;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $errorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
    }

    if (!$uploadOk) {
        return ['flag' => false, 'errorMessage' => $errorMessage];
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return ['flag' => true, 'image_url' => $target_file];
        }
    }

    return ['flag' => false, 'errorMessage' => $file["error"]];
}

function getBaseUrl()
{
    $serverName = $_SERVER["SERVER_NAME"];
    $serverPort = $_SERVER["SERVER_PORT"];
    $requestUri = $_SERVER['REQUEST_URI'];

    if (in_array($serverPort, [80, 443])) {
        return 'http://' . $serverName . $requestUri;
    } else {
        return 'http://' . $serverName . ':' . $serverPort . $requestUri;
    }
}

function getCountDownDate($votingDb)
{
    $query = "select value from settings where settings_name = '%s'";
    $result = $votingDb->query(sprintf($query, 'countdown'))->fetch_row();
    $date = array_shift($result);

    return $date;
}

function getMaxVotesPerUser($votingDb)
{
    $query = "select value from settings where settings_name = '%s'";
    $result = $votingDb->query(sprintf($query, 'maximumCount'))->fetch_row();
    $maxCount = array_shift($result);

    return $maxCount;
}


function generatePasswordHash($password)
{
    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    $password = password_hash($password, PASSWORD_BCRYPT, $options);

    return $password;
}

function getUserByEmail($votingDb, $email)
{
    $query = "select * from users where email='" . $email . "'";
    $result = $votingDb->query($query)->fetch_all();

    return $result ? true : false;
}

function getVotes($votingDb, $beerid)
{
    $result = $votingDb->query(sprintf('select count(*) from users_votes where beer_id = %d', $beerid))->fetch_row();

    return $result[0];
}

function getSite()
{
    $serverName = $_SERVER["SERVER_NAME"];
    $serverPort = $_SERVER["SERVER_PORT"];

    if (in_array($serverPort, [80, 443])) {
        return 'http://' . $serverName;
    } else {
        return 'http://' . $serverName . ':' . $serverPort . '/';
    }
}

function getNumberOfVotesForCurrentWeek($votingDb, $userId)
{
    $lastVotedOn = getLastVotedOn($votingDb, $userId);
    $monday = beginningOfWeek($lastVotedOn);
    $query = "select count(*) from users_votes WHERE date_voted between '%s' AND '%s' AND user_id = %d";
    $result = $votingDb->query(sprintf($query, $monday, $lastVotedOn, $userId))->fetch_row();

    return array_shift($result);
}

function getAllUsers($votingDb)
{
    $results = $votingDb->query("select * from users");

    return $results;
}

function getLastVotedOn($votingDb, $userId)
{
    $query = "select last_voted_on from users where id =%d";
    $result = $votingDb->query(sprintf($query, $userId))->fetch_row();
    $unixDate = array_shift($result);

    return $unixDate;
}

function beginningOfWeek($time = null, $firstDayOfWeek = 0)
{
    if ($time === null) {
        $date = getdate();
    } else {
        $date = getdate($time);
    }

    return $date[0]
    - ($date['wday'] * 86400)
    + ($firstDayOfWeek * 86400)
    - ($date['hours'] * 3600)
    - ($date['minutes'] * 60)
    - $date['seconds'];

}

function getBeerById($votingDb, $beer_id)
{
    $query = "select * from beers where id=%d";

    $results = $votingDb->query(sprintf($query, $beer_id))->fetch_row();

    return $results;
}

function deleteBeerById($votingDb, $beer_id)
{
    $query = "delete from beers where id=%d";

    $bFlag = $votingDb->query(sprintf($query, $beer_id));

    return $bFlag;
}