<?
include_once( $_SERVER['DOCUMENT_ROOT'].'/qs_connection.php' );
include_once($_SERVER['DOCUMENT_ROOT'] . '/common/constants.php');
$time = getCountDownDate($votingDb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="google-signin-client_id" content="58560362504-t3gja5tiip7gi5b9gvqckflu7g1belsd.apps.googleusercontent.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<? echo ROOT_ASSETS?>js/countdown.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/pwdwidget.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/validator.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="<? echo ROOT_ASSETS; ?>/owl-carousel/owl.carousel.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/bootstrap-collapse.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/bootstrap-transition.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/bootstrap-tab.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/google-code-prettify/prettify.js"></script>
    <script src="<? echo ROOT_ASSETS; ?>js/application.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo ROOT_ASSETS; ?>css/common.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<? echo ROOT_ASSETS; ?>css/bootstrapTheme.css" rel="stylesheet">
    <link href="<? echo ROOT_ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<? echo ROOT_ASSETS; ?>owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<? echo ROOT_ASSETS; ?>owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="<? echo ROOT_ASSETS; ?>js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<? echo ROOT_ASSETS; ?>ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<? echo ROOT_ASSETS; ?>ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<? echo ROOT_ASSETS; ?>ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<? echo ROOT_ASSETS; ?>ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<? echo ROOT_ASSETS; ?>ico/favicon.png">
</head>
</html>

<input id="deadline" value="<? echo $time ?>" class="hidden"/>
<input id="baseUrl" value="<? echo getBaseUrl() ?>" class="hidden"/>
<input id="siteUrl" value="<? echo getSite() ?>" class="hidden"/>