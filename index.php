<?php

require('flight/Flight.php');
include("includes/common.inc.php");
require_once("includes/AdminUtils.inc.php");
require_once("includes/DataAccess.inc.php");
require_once("includes/ViewHelpers.inc.php");

include('controllers/site.php');
include('controllers/admin.php');
include('controllers/authentication.php');
include('controllers/categories.php');
include('controllers/images.php');
include('controllers/posts.php');

$da = new DataAccess($link);
$au = new AdminUtils();

Flight::start();