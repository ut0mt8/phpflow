<?php

$link = array(
  'if' => makelink("page","if"),
  'asn' => makelink("page","asn"),
  'asp' => makelink("page","asp"),
  'ctry' => makelink("page","ctry"),
  'talk' => makelink("page","talk"),
  'sess' => makelink("page","sess"),
  'in' => makelink("direction","in"),
  'out' => makelink("direction","out"),
);

$custs = make_cust_select($cust);
$intervals = make_interval_select($interval);

$tpl = $twig->loadTemplate('header.tmpl');
echo $tpl->render(array(
  'link' => $link,
  'page' => $page,
  'direction' => $direction,
  'stamp_min' => $stamp_min,
  'stamp_max' => $stamp_max,
  'intervals' => $intervals,
  'custs' => $custs,
));
