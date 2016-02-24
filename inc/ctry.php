<?php

$sql = "select ".$ctry." as ctry, ";
$sql .= "sum(bytes)*8*".$sampling_rate."/".$interval." traffic, ";
$sql .= "sum(packets)*".$sampling_rate."/".$interval." pps ";
$sql .= "from ".$table." ";
$sql .= "where stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
if ($if != "") $sql .= "and tag = ".$if." ";
if ($cust != "") $sql .= "and tag2 = ".$cust." ";
$sql .= "group by ".$ctry." order by sum(bytes) desc limit ".$entry_limit;

$result = do_query($sql);
$rows = array();

while($row = mysqli_fetch_array($result)) {
  if ($row['ctry'] != "--")
    array_push($rows,$row);
}

/* clean formating */
foreach ($rows as $key => $row) {
  $traffic = formatUnit($row['traffic']);
  $pps = formatUnit($row['pps']);
  $rows[$key]['traffic'] = $traffic;
  $rows[$key]['pps'] = $pps;
}

$tpl = $twig->loadTemplate('ctry.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
  'direction' => $direction
));
