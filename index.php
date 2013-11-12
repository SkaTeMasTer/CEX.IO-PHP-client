<?php 
/*
 * CEX.IO - Bitcoin 
 *
 * This sample is made available by MasterX1582.
 * If this is usefull for you, feel free to support me by sending some bitcoins to 1MegaXG1bd6mTEQCdAMjVzGexcYrF5LJKv
 * I can absolutely not be held responsible by any losses made by use of this piece of code. 
 * You are the only person totaly responsible for running this software.
 * 
 * Enjoy!
 */
include('config.inc.php');
include('cexio-grabber.php'); 
// Define Currency/Commodity Symbols
define('BTCSYM','&#3647;');
define('GHZSYM','GHS');
// Show Account name.
print "CEX.IO Account info for " .USERNAME. "<br><br>";
// Show the ticker.
$ticker = cexio_query('https://cex.io/api/ticker/GHS/BTC');
echo "High Price: ";
echo print_r($ticker['high']."\n", true);
echo "<br>Last Price: ";
echo print_r($ticker['last']."\n", true);
echo "<br>Low Price: ";
echo print_r($ticker['low']."\n", true);
// Show balances.
$balance = cexio_query('https://cex.io/api/balance/');
// But only when availanble!
if (isset($balance['BTC']['available'])){
	if ($balance['BTC']['available']> 0){
		print "<br><br>Bitcoins Available: <br>";
		print $balance['BTC']['available']. " " .BTCSYM;
	}
}
if (isset($balance['BTC']['orders'])){
	if ($balance['BTC']['orders']> 0){
		print "<br><br>Bitcoins in Orders: <br>";
		print $balance['BTC']['orders']. " " .BTCSYM. "<br>";
		define('TOTBTC',($balance['BTC']['orders'] + $balance['BTC']['available']));
		print "<br><br>Total Bitcoin on Account: <br>";
		print TOTBTC. " " .GHZSYM. "<br>";
	}
}
if (isset($balance['GHS']['available'])){
	if ($balance['GHS']['available']> 0){
		print "<br><br>Gigahash Available: <br>";
		print $balance['GHS']['available']. " " .GHZSYM;
	}
}
if (isset($balance['GHS']['orders'])){
	if ($balance['GHS']['orders']> 0){
		print "<br><br>GigaHash for Sale: <br>";
		print $balance['GHS']['orders']. " " .GHZSYM. "<br>";
		define('TOTGHS',($balance['GHS']['orders'] + $balance['GHS']['available']));
		print "<br><br>Total GigaHash on Account: <br>";
		print TOTGHS. " " .GHZSYM. "<br>";
	}
}
?>