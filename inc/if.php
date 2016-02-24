<?php

$table = "netflow_if_".$direction;

$sql = "select iface_desc, iface_id, router_desc, ";
$sql .= "sum(bytes)*8*".$sampling_rate."/".$interval." traffic, ";
$sql .= "sum(packets)*".$sampling_rate."/".$interval." pps ";
$sql .= "from ".$table.", interface_map ";
$sql .= "where tag = iface_id ";
if ($cust != "") $sql .= "and tag2 = ".$cust." ";
$sql .= "and stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
$sql .= "group by tag order by sum(bytes) desc";

$result = do_query($sql);

$total_traffic = 0;
$total_pps = 0;
$rows = array();

while($row = mysqli_fetch_array($result)) {
  array_push($rows,$row);
  $total_traffic += $row['traffic'];
  $total_pps += $row['pps'];
}

/* compute percent use and clean formating */
foreach ($rows as $key => $row) {
  $percent = round($row['traffic']/$total_traffic*100);
  $traffic = formatUnit($row['traffic']);
  $pps = formatUnit($row['pps']);
  $rows[$key]['percent'] = $percent;
  $rows[$key]['traffic'] = $traffic;
  $rows[$key]['pps'] = $pps;
}

$tpl = $twig->loadTemplate('if.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
  'direction' => $direction,
  'total_traffic' => formatUnit($total_traffic),
  'total_pps' => formatUnit($total_pps)
));
