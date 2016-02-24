<?php

if (($direction) == 'out') {

  $sql = "select ".$asq." asq, as_name, as_path, ";
  $sql .= "sum(bytes)*8*".$sampling_rate."/".$interval." traffic, ";
  $sql .= "sum(packets)*".$sampling_rate."/".$interval." pps ";
  $sql .= "from ".$table.",asn ";
  $sql .= "where ".$asq."=as_number ";
  if ($if != "") $sql .= "and tag = ".$if." ";
  if ($cust != "") $sql .= "and tag2 = ".$cust." ";
  $sql .= "and stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
  $sql .= "group by as_path order by sum(bytes) desc limit ".$entry_limit;

  $result = do_query($sql);

  $total_traffic = 0;
  $total_pps = 0;
  $rows = array();

  while($row = mysqli_fetch_array($result)) {
    array_push($rows,$row);
    $total_traffic += $row['traffic'];
    $total_pps += $row['pps'];
  }

  /* clean formating */
  foreach ($rows as $key => $row) {
    $traffic = formatUnit($row['traffic']);
    $pps = formatUnit($row['pps']);
    $rows[$key]['traffic'] = $traffic;
    $rows[$key]['pps'] = $pps;
  }

  $tpl = $twig->loadTemplate('asp.tmpl');
  echo $tpl->render(array(
    'rows' => $rows,
    'direction' => $direction,
    'total_traffic' => formatUnit($total_traffic),
    'total_pps' => formatUnit($total_pps)
  ));

} else {
  $tpl = $twig->loadTemplate('wrong.tmpl');
  echo $tpl->render(array());
}
