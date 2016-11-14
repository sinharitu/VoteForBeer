<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include($_SERVER['DOCUMENT_ROOT'] . '/common/header.php');

$result = getAllUsers($votingDb);
$allUsers = $result->fetch_all();

if ($allUsers){
?>
<div class="container data-grid table-responsive">
    <h1>List of users</h1>
    <table class="table table-condensed table-hover table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Is gmail account?</th>
            <th>Last voted on</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allUsers as $user) { ?>
            <tr>
                <td><? echo $user[0] ?></td>
                <td><? echo $user[1] ?></td>
                <td><? echo $user[2] ?></td>
                <td><? echo $user[4] ?></td>
                <td><? echo $user[7] ? 'yes' : 'no'; ?></td>
                <td><? echo date('m/d/y', $user[6]); ?></td>
            </tr>
        <? } ?>
        </tbody>
    </table>
    <? } else {
        echo 'No Users created';
    } ?>
    <div class="row">
        <div class="col-sm-1">
            <button type="button" class="btn btn-primary" id="cancel">Back</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#cancel').click(function(e){
        window.location.href = '/admin';
    });
</script>
<?
include($_SERVER['DOCUMENT_ROOT'] . '/common/footer.php');
$votingDb->close();
?>

