<?php 
include('config.inc.php');
include('cexio-grabber.php'); 

$json = json_encode(cexio_query('https://cex.io/api/balance/'));
$balance_o = json_decode($json,true);
echo "CEX.IO Account for " .USERNAME. "<br><br>";
if (isset($balance_o['BTC']['available'])){
	if ($balance_o['BTC']['available']> 0){
		print "Bitcoins Available: <br>";
		print $balance_o['BTC']['available'];
		print " &#3647;";
	}
}
if (isset($balance_o['BTC']['orders'])){
	if ($balance_o['BTC']['orders']> 0){
		print "<br>";
		print "<br>";
		print "Bitcoins in Orders: <br>";
		print $balance_o['BTC']['orders'];
		print " &#3647;";
	}
}
if (isset($balance_o['GHS']['available'])){
	if ($balance_o['GHS']['available']> 0){
		print "<br>";
		print "<br>";
		print "Gigahash Available: <br>";
		print $balance_o['GHS']['available'];
		print " GHS";
	}
}

if (isset($balance_o['GHS']['orders'])){
	if ($balance_o['GHS']['orders']> 0){
		print "<br>";
		print "<br>";
		print "GigaHash for Sale: <br>";
		print $balance_o['GHS']['orders'];
		print " GHS";
	}
}
?>
