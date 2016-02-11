<?php

$rootdir = '/var/www/phpflow/';
include("$rootdir/inc/sql.php");
include("$rootdir/inc/func.php");

//initialize Twig environment
include('Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem("$rootdir/tmpl");
$twig = new Twig_Environment($loader);

//global parameters
$sampling_rate = "1000";
$entry_limit = 20;

//defaults values
if(!isset($_GET['page'])) $page = "if";
else $page = $_GET['page'];

if(!isset($_GET['direction'])) $direction = "out";
else $direction = $_GET['direction'];

if(!isset($_GET['interval'])) $interval = "300";
else $interval = $_GET['interval'];

//specific queries
if(!isset($_GET['if'])) $if = "";
else $if = $_GET['if'];

if(!isset($_GET['cust'])) $cust = "";
else $cust = $_GET['cust'];

if ($cust == "000") $cust = "";

if ($direction == "in") {
  $asq = "as_src";
  $ctry = "country_ip_src";
} else {
  $asq = "as_dst";
  $ctry = "country_ip_dst";
}

$stamp_max = time(); 
$stamp_min = strtotime(date('Y-m-d H:i:00', $stamp_max - $interval)); //rounded to 5min minus interval
$stamp_max = date("Y-m-d H:i:00",$stamp_max);
$stamp_min = date("Y-m-d H:i:00",$stamp_min);
$table = "netflow_".$direction."_hour";

