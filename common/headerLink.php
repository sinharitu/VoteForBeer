<ul class="headerLink">
    <li>Last voted on : <?php echo date('m/d/y', getLastVotedOn($votingDb, $_SESSION['userid'])); ?></li>
    <?php if ($_SESSION['isAdmin']){ ?>|<li><a href="<?php echo getSite(); ?>admin">admin panel</a></li><?php }?>
    |
    <li><a href="<?php echo getSite(); ?>common/logout.php" id="logout">logout</a></li>
</ul>
<script type="text/javascript">
    $('#logout').click(function (e) {
        signOut();
    })

    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
        });
    }

    function onLoad() {
        gapi.load('auth2', function () {
            gapi.auth2.init();
        });
    }
</script>