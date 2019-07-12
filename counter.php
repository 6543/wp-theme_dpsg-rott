<?php
$file = fopen("counter.txt", "r+");
$visitors = fgets($file);
?>
<!DOCTYPE html>
<html>
<head>
<title>Besucher | Pfadfinder Rott</title>
<meta charset="utf-8">
<script type="text/javascript" src="cnanney/js/flipcounter.min.js"></script>
<script type="text/javascript" src="cnanney/js/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="cnanney/css/counter.css" />
<script type="text/javascript">
var myCounter;
$(document).ready(function() {
	myCounter = new flipCounter("counter", {value:<?php print $visitors; ?>, auto:false});
	$.ajaxSetup({
		timeout: 5000
	});
	$.ajax({
		url: "visitors.php",
		success: function( data ) {
			myCounter.setValue(data);
		}
	});
});

window.setInterval(function(){
	$.ajaxSetup({
		timeout: 5000
	});
	$.ajax({
		url: "visitors.php",
		success: function( data ) {
			myCounter.setValue(data);
		}
	});
}, 10000);
</script>
</head>
<div class="wrapper" style="height:103px;width:226px;margin:auto;"><div id="counter" class="flip-counter"></div></div>
</body>
</html>