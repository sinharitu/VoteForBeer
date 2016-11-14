<?
include_once '../common/header.php';
$setting_1 =  getCountDownDate($votingDb);
$setting_2 =  getMaxVotesPerUser($votingDb);
?>
<head>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<h1>Admin settings</h1>
<form id="adminSettings" method="post" action="common/saveSettings.php">
    <div class="container">
        <table width="503" border="1" align="center">
            <thead>
            <tr>
                <th>setting name</th>
                <th>set value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Set the deadline for voting</td>
                <td><input type="text" id="datepicker" name="settings_1" class="adminClass" value="<? echo $setting_1 ?>" required /></td>
            </tr>
            <tr>
                <td>Maximum number of votes per user</td>
                <td><input type="number" name="settings_2" min="1" max="10" class="adminClass" value="<? echo $setting_2 ?>" required /></td>
            </tr>
            </tbody>
        </table>
        <div class="row buttonAlign">
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary" id="saveForm">Save</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker();
    });

    $('#saveForm').click(function (e) {
        $('#adminSettings').submit();
    });

    $('#cancel').click(function(e){
        window.location.href ='/admin';
    })
</script>
<?php
include_once '../common/footer.php';
?>