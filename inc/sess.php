<?php

$sql = "select ip_src, ip_dst, port_src, port_dst, country_ip_dst, ";
$sql .= $asq." asq, asn.as_name, ";
$sql .= "round(sum(bytes)*8*".$sampling_rate."/1000000/".$interval.",1) traffic, ";
$sql .= "round(sum(packets)*".$sampling_rate."/".$interval.",0) pps ";
$sql .= "from ".$table.",asn ";
$sql .= "where ".$asq."=as_number ";
if ($if != "") $sql .= "and tag = ".$if." ";
if ($cust != "") $sql .= "and tag2 = ".$cust." ";
$sql .= "and stamp_inserted between '".$stamp_min."' and '".$stamp_max."' ";
$sql .= "group by ip_src, ip_dst, port_src, port_dst order by sum(bytes) desc limit ".$entry_limit;

$result = do_query($sql);

$rows = array();
while($row = mysqli_fetch_array($result)) {
  array_push($rows,$row);
}

$tpl = $twig->loadTemplate('sess.tmpl');
echo $tpl->render(array(
  'rows' => $rows,
  'direction' => $direction
));
