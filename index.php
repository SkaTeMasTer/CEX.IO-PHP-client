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
// Show GHS the ticker.
echo "High Price: ";
echo $tickerGHS->price->high;
echo "<br>Last Price: ";
echo $tickerGHS->price->last;
echo "<br>Low Price: ";
echo $tickerGHS->price->low;

/* Disabled due to beïng not available a.t.m.
echo "<br>High Price: ";
echo $tickerBF1->price->high;
echo "<br>Last Price: ";
echo $tickerBF1->price->last;
echo "<br>Low Price: ";
echo $tickerBF1->price->low;
*/

// Show balances.
if (isset($balance->btc->available)){
	if ($balance->btc->available> 0){
		// BTC Balance
		print "<br><br>Bitcoins Available: <br>";
		print $balance->btc->available. " " .BTCSYM;
	}
}
if (isset($balance->btc->orders)){
	if ($balance->btc->orders> 0){
		// BTC Balance on Orders
		print "<br><br>Bitcoins in Orders: <br>";
		print $balance->btc->orders. " " .BTCSYM. "<br>";
		// Total BTC Owned
		print "<br><br>Total Bitcoins on Account: <br>";
		print $balance->btc->total. " " .GHZSYM. "<br>";
	}
}
if (isset($balance->ghs->available)){
	if ($balance->ghs->available> 0){
		// GHS on Stock
		print "<br><br>Gigahash Available: <br>";
		print $balance->ghs->available. " " .GHZSYM;
	}
}
if (isset($balance->ghs->orders)){
	if ($balance->ghs->orders> 0){
		// GHS for Sale
		print "<br><br>GigaHash for Sale: <br>";
		print $balance->ghs->orders. " " .GHZSYM. "<br>";
		// Total GHS Owned
		print "<br><br>Total GigaHash on Account: <br>";
		print $balance->ghs->total. " " .GHZSYM. "<br>";
	}
}
if (isset($balance->bf1->available)){
	if ($balance->bf1->available> 0){
		// BF1 on Stock
		print "<br><br>Bitfuryh Available: <br>";
		print $balance->bf1->available. " " .GHZSYM;
	}
}
if (isset($balance->bf1->orders)){
	if (isset($balance->bf1->orders) || $balance->bf1->orders> 0){
		// BF1 for Sale
		print "<br><br>Bitfury for Sale: <br>";
		print $balance->bf1->orders. " " .GHZSYM. "<br>";
		// Total BF1 Owned
		print "<br><br>Total Bitfury on Account: <br>";
		print $balance->bf1->total. " " .GHZSYM. "<br>";
	}
}
//
// More stuff to be added...
?>