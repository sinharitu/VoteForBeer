<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/common/header.php');

if($_SESSION['isAdmin']){ ?>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo getSite();?>/assets/css/admin.css">
    </head>
    <body>
    <div class="container">
        <table width="503" border="1" align="center">
            <tr>
                <td align="center" valign="middle" class="TrHover"><span class="style1">ADMINISTRATION PANEL </span></td>
            </tr>
            <tr>
                <td class="TrHover style5">&nbsp;</td>
            </tr>
            <tr>
                <td class="TrHover"><a href="users.php" class="TrHover style6">List of Users</a> </td>
            </tr>
            <tr>
                <td class="TrHover"><a href="beer.php" class="style5">List of Beer</a> </td>
            </tr>
            <tr>
                <td class="TrHover"><a href="../vote" class="style5">Go to voting page</a> </td>
            </tr>
            <tr>
                <td class="TrHover"><a href="settings.php" class="style5">Settings</a> </td>
            </tr>
            <tr>
                <td class="TrHover">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" class="TrHover"><a href="../common/logout.php" class="style7">Log-out</a> </td>
            </tr>
        </table>
    </div>
    </body>
<?php }elseif($_SESSION['loggedin']){  ?>
    <h3>You do not have access to this page</h3></div>
<?php }else{ ?>
    <h3><a href="<?php echo getSite(); ?>login/index.php" class="TrHover homepage">Login to access the page</a></h3></div>
<?php } ?>