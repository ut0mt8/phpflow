<?php

function makelink($param,$value) {
  $params = array();
  $params = $_GET;
  $params[$param] = "$value";
  $queryString = http_build_query($params,'');
  $link = "index.php?".$queryString;
  return $link;
}

function make_cust_select($current) {
  $rows = array();
  $sql = "select id, name from custs order by name";
  $result = do_query($sql);

  while($row = mysqli_fetch_array($result)) {
    $row['link'] = makelink("cust", $row['id']);
    if ($row['id'] == $current) $row['selected'] = "selected";
    else $row['selected'] = "";
    array_push($rows,$row);
  }
  return $rows;
}

function make_interval_select($current) {
  $rows = array();
  $sql = "select seconds, name from intervals order by seconds";
  $result = do_query($sql);

  while($row = mysqli_fetch_array($result)) {
    $row['link'] = makelink("interval", $row['seconds']);
    if ($row['seconds'] == $current) $row['selected'] = "selected";
    else $row['selected'] = "";
    array_push($rows,$row);
  }
  return $rows;
}
