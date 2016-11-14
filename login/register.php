<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/common/header.php');
?>
<div id='fg_membersite'>
    <form id='register' method='post' accept-charset='UTF-8'>
        <fieldset>
            <legend>Register</legend>
            <div class='short_explanation'>* required fields</div>
            <div class='container'>
                <label for='name'>Your Full Name*: </label><br/>
                <input type='text' name='name' id='name' value='' maxlength="50" required/><br/>
            </div>
            <div class='container'>
                <label for='email'>Email Address*:</label><br/>
                <input type='text' name='email' id='email' value='' maxlength="50" required/><br/>
            </div>
            <div class='container'>
                <label for='username'>UserName*:</label><br/>
                <input type='text' name='username' id='username' value='' maxlength="50" required/><br/>
            </div>
            <div class='container'>
                <label for='password'>Password*:</label><br/>
                <input type='password' name='password' id='password' maxlength="50" required/>
            </div>
            <div class='container'>
                <button type="button" id="createUser">Submit</button>
            </div>
        </fieldset>
    </form>
    <script type='text/javascript'>
        $('.pwdopsdiv').hide();
        $('#createUser').click(function (e) {
            var url = '/ajax/createUser.php';
            var name = $('#name').val();
            var password = $('#password').val();
            var email = $('#email').val();
            var username = $('#username').val();
            $.ajax({
                url: url,
                data: {'name': name, 'password': password, 'email': email, 'username': username},
                type: 'post',
                datatype: 'json',
                success: function (output) {
                    var response = JSON.parse(output);
                    if (response.flag == true) {
                        confirm(response.message)
                        {
                            window.location.assign('/vote');
                        }
                    }
                }
            });
        });
        // <![CDATA[
        var frmvalidator = new Validator("register");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("name", "req", "Please provide your name");

        frmvalidator.addValidation("email", "req", "Please provide your email address");

        frmvalidator.addValidation("email", "email", "Please provide a valid email address");

        frmvalidator.addValidation("username", "req", "Please provide a username");

        frmvalidator.addValidation("password", "req", "Please provide a password");

        // ]]>
    </script>