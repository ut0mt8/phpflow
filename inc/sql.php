<?php

$db_user="pmacct";
$db_passwd="Qgg8sZAVmi";
$db_host="10.3.0.20";
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
