<?php

if ($direction == "out") {
  $ips1 = "ip_src";
  $ips2 = "ip_dst";
} else {
  $ips1 = "ip_dst";
  $ips2 = "ip_src";
}

$sql = "select ".$ips1." ipa, ";
$sql .= "sum(bytes)*8*".$sampling_rate."/".$interval." traffic ";
$sql .= "from ".$table." ";
$sql .= "where stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
if ($cust != "") $sql .= "and tag2 = ".$cust." ";
$sql .= "group by ipa order by sum(bytes) desc limit ".$entry_limit;

$result = do_query($sql);

$rows = array();
while($row = mysqli_fetch_array($result)) {
  array_push($rows,$row);
}

/* search for reverse and clean formating */
foreach ($rows as $key => $row) {
  $hostname = gethostbyaddr($row['ipa']);
  $traffic = formatUnit($row['traffic']);
  $rows[$key]['name'] = $hostname;
  $rows[$key]['traffic'] = $traffic;
}

$tpl = $twig->loadTemplate('talk.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
  'direction' => $direction
));

