<?php
$xml = simplexml_load_file('http://dpsg-rott.de/kiwip/index.php?module=API&method=VisitsSummary.getVisits&idSite=1&period=year&date=2013-08-17&format=xml&token_auth=94d0d86eb541dd3f518fdd08db717ecb');
$visitors = $xml[0];
$file = fopen("counter.txt", "r+");
fseek($file, 0);
fwrite($file, $visitors);
print $xml[0];
?>