<?php

$table = "netflow_asn_".$direction;

$sql = "select ".$asq." asq, as_name, ";
$sql .= "round(sum(bytes)*8*".$sampling_rate."/1000000/".$interval.",1) traffic, ";
$sql .= "round(sum(packets)*".$sampling_rate."/".$interval.",0) pps ";
$sql .= "from ".$table.",asn ";
$sql .= "where ".$asq."=as_number ";
if ($if != "") $sql .= "and tag = ".$if." ";
if ($cust != "") $sql .= "and tag2 = ".$cust." ";
$sql .= "and stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
$sql .= "group by ".$asq." order by sum(bytes) desc limit ".$entry_limit;

$result = do_query($sql);

$total_traffic = 0;
$total_pps = 0;
$rows = array();
while($row = mysqli_fetch_array($result)) {
  array_push($rows,$row);
  $total_traffic += $row['traffic'];
  $total_pps += $row['pps'];
}

$tpl = $twig->loadTemplate('asn.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
  'direction' => $direction,
  'total_traffic' => $total_traffic,
  'total_pps' => $total_pps
));
