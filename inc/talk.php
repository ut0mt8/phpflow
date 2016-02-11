<?php

if ($direction == "out") {
  $ips1 = "ip_src";
  $ips2 = "ip_dst";
} else {
  $ips1 = "ip_dst";
  $ips2 = "ip_src";
}

$sql = "select ".$ips1." ipa, ";
$sql .= "round(sum(bytes)*8*".$sampling_rate."/1000000/".$interval.",1) traffic ";
$sql .= "from ".$table." ";
$sql .= "where stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
if ($cust != "") $sql .= "and tag2 = ".$cust." ";
$sql .= "group by ipa order by sum(bytes) desc limit ".$entry_limit;

$result = do_query($sql);

$rows = array();
while($row = mysqli_fetch_array($result)) {
  array_push($rows,$row);
}

/* search for reverse */
foreach ($rows as $key => $row) {
  $hostname = gethostbyaddr($row['ipa']);
  $rows[$key]['name'] = $hostname;
}

/*
$sql = "select ".$ips2." ipa, ".$ctry." ctry, ";
$sql .= $asq." asq, asn.as_name, ";
$sql .= "round(sum(bytes)*8*".$sampling_rate."/1000000/".$interval.",1) traffic ";
$sql .= "from ".$table.", asn ";
$sql .= "where ".$asq."=as_number ";
$sql .= "and stamp_updated between '".$stamp_min."' and '".$stamp_max."' ";
$sql .= "group by ipa order by sum(bytes) desc limit ".$entry_limit;

$result = do_query($sql);

$rows2 = array();
while($row = mysqli_fetch_array($result)) {
  array_push($rows2,$row);
}
*/

$tpl = $twig->loadTemplate('talk.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
//  'rows2' => $rows2,
  'direction' => $direction
));

