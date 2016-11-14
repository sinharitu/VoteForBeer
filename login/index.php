<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/common/header.php'); ?>
<h2>Login Form</h2>
<form action="loginAction.php" id="loginForm" method="post">
    <div class="container">
        <div class="row">
            <div class="loginContainer col-sm-8">
                <div class="imgcontainer">
                    <img src="<? echo ROOT_IMAGE ?>/login.png" alt="Avatar" class="avatar">
                </div>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" value="submit" class="btn btn-primary" id="login">Login</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary" id="cancel">Cancel</button>
                    </div>
                    <a href="register.php" id="createlogin">Create an account</a>
                </div>
            </div>
            <div class="row">
            <h2>Sign in using gmail</h2>
            <div class="g-signin2 col-sm-4" data-onsuccess="onSignIn"></div>
          </div>
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
    $('#cancel').click(function (e) {
        window.location.href = '/';

    });

    $('#login').click(function (e) {
        $('#loginForm').submit();
    })

    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        var data = {'name':profile.getName(), 'email':profile.getEmail(), 'image_url': profile.getImageUrl()};
        var auth2 = gapi.auth2.getAuthInstance();
        if (auth2.isSignedIn.get()) {
            url = '/ajax/tokenSignIn.php';
            $.ajax({
                url: url,
                data: data,
                type: 'post',
                datatype: 'json',
                success: function (output) {
                        window.location.assign('/vote');
                }
            });
        }
    }
</script>
<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'); ?>

