<?php
include_once ('functions.php');

define('BASEURL', getBaseUrl());
define('SITEURL', getSite());
define('DOCUMENTROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROOT_COMMON', $_SERVER['DOCUMENT_ROOT'].'/common');
define('ROOT_ADMIN', $_SERVER['DOCUMENT_ROOT'].'/admin');
define('ROOT_IMAGE', getSite().'assets/images/');
define('ROOT_ASSETS', getSite().'assets/');

?>