<?php
ini_set( 'session.gc_maxlifetime', 36000 );
session_start();
ob_start();

include_once ('common/header.php');
?>
<div class="container homepage">
    <h1>Vote for your favourite beer</h1>
    <p>
    <img src="<?php echo ROOT_IMAGE ?>beer.png" class="img-thumbnail img-circle"/>
    </p>
    <div id="clockdiv">
        <div>
            <span class="days"></span>
            <div class="smalltext">Days</div>
        </div>
        <div>
            <span class="hours"></span>
            <div class="smalltext">Hours</div>
        </div>
        <div>
            <span class="minutes"></span>
            <div class="smalltext">Minutes</div>
        </div>
        <div>
            <span class="seconds"></span>
            <div class="smalltext">Seconds</div>
        </div>
    </div>
<script type="text/javascript">
    dateEndDate =$('#deadline').val();
    var deadline = new Date(dateEndDate);
    initializeClock('clockdiv', deadline);
</script>
<?php
if(!$_SESSION['loggedin'] || $_COOKIE['id_token'])
{?>
    <h3><a href="login/index.php" class="TrHover homepage">Login to vote for your favourite beer</a></h3></div>
<?php}
else{?>
    <h3><a href="vote" class="TrHover homepage">Vote for your favourite beer</a></h3></div>
<?php}
?>