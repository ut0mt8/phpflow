<?php

$db_user="pmacct";
$db_passwd="XXX";
$db_host="127.0.0.1";
$db_name="pmacct";

$dbh = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
if ($dbh->connect_errno) {
    echo "Failed to connect to MySQL: ".$mysqli->connect_error;
}

function do_query($sql){
  global $dbh;

  //print $sql;
  $res = mysqli_query($dbh,$sql);
  if (!$res) {
    echo "Failed to run query: (".$dbh->errno.") ".$dbh->error;
  }

  return $res;
}
