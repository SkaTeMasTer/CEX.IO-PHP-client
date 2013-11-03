<?php 
include('config.inc.php');
include('cexio-grabber.php'); 

$json_balance = json_encode(cexio_query('https://cex.io/api/balance/'));
$balance_o = json_decode($json_balance,true);

// Set Symbols
define('BTCSYM','&#3647;');
define('GHZSYM','GHS');

echo "CEX.IO Account for " .USERNAME. "<br><br>";
if (isset($balance_o['BTC']['available'])){
	if ($balance_o['BTC']['available']> 0){
		print "Bitcoins Available: <br>";
		print $balance_o['BTC']['available']. " " .BTCSYM;
	}
}
if (isset($balance_o['BTC']['orders'])){
	if ($balance_o['BTC']['orders']> 0){
		print "<br><br>Bitcoins in Orders: <br>";
		print $balance_o['BTC']['orders']. " " .BTCSYM;
	}
}
if (isset($balance_o['GHS']['available'])){
	if ($balance_o['GHS']['available']> 0){
		print "<br><br>Gigahash Available: <br>";
		print $balance_o['GHS']['available']. " " .GHZSYM;
	}
}

if (isset($balance_o['GHS']['orders'])){
	if ($balance_o['GHS']['orders']> 0){
		print "<br><br>GigaHash for Sale: <br>";
		print $balance_o['GHS']['orders']. " " .GHZSYM;
	}
}
?>
