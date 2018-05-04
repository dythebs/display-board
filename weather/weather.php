<?php
include './config.php';
$url = $weatherUrl;
include "simple_html_dom.php";
$html = new simple_html_dom();
$html->load_file($url);
$links = $html->find('link');
echo '<div       data-data="1"            style="';echo $html->find('div[id=skin]')[0]->style; echo ';width:100%;height:100%;">';
#echo '<div style="width:100%" >';
foreach ($links as $l)
{
    echo $l;
}
#echo $html->find('div[id=skin]')[0];
echo $html->find('div[class=wrap clearfix wea_info]')[0]->find('div[class=left]')[0];
echo '</div>';
?>
