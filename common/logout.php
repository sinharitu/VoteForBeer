<?php
include ($_SERVER['DOCUMENT_ROOT'].'/common/header.php');
session_destroy();
?>
<script type="text/javascript">
    $( document ).ready(function() {
        gapi.load('auth2', function () {
            gapi.auth2.init();
        });
        window.location.href='/';
    });
</script>