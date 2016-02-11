<?php

$sql = "select ".$ctry." as ctry, ";
$sql .= "round(sum(bytes)*8*".$sampling_rate."/1000000/".$interval.",1) traffic, ";
$sql .= "round(sum(packets)*".$sampling_rate."/".$interval.",0) pps ";
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

$tpl = $twig->loadTemplate('ctry.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
  'direction' => $direction
));
