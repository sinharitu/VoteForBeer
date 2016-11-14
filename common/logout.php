<?php
include_once ('../common/header.php');
$_SESSION['loggedin']=false;
$_SESSION['userid']=null;
$_SESSION['isAdmin']=null;
?>
<script type="text/javascript">
    $( document ).ready(function() {
        window.location.href='/';
    });
</script>