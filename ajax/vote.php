<?php
include_once '../qs_connection.php';
include_once '../common/functions.php';

$alreadyVoted = getNumberOfVotesForCurrentWeek($votingDb, $_SESSION['userid']);
$allowedNumberOfVotes = getMaxVotesPerUser($votingDb);

if ($alreadyVoted == $allowedNumberOfVotes) {
    echo(json_encode([
        'flag' => false,
        'message' => 'Sorry you have exceeded the maximum number of votes for this week'
    ]));

    return;
}

$beer_id = $_POST['id'];
$userId = $_SESSION['userid'];
$date_voted = time();

$query = "insert into users_votes (user_id, beer_id, date_voted) VALUES (%d, %d,'%s')";
$flag = $votingDb->query(sprintf($query, $userId, $beer_id, $date_voted));
if ($flag) {
    $queryUpdate = "update users set last_voted_on ='%s' where id = %d";
    $flagUpdate = $votingDb->query(sprintf($queryUpdate, time(), $userId));
    $votes = getVotes($votingDb, $beer_id);
    echo(json_encode([
        'flag' => $flagUpdate,
        'message' => 'Your vote has been recorded successfully',
        'votes' => $votes
    ]));
} else {
    echo(json_encode(['flag' => false, 'message' => 'There was an error while voting for the beer!!!']));
}
