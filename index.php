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
// Report all errors except E_NOTICE
// This is the default value set in php.ini
error_reporting(E_ALL ^ E_NOTICE);
include('config.inc.php');
include('cexio-grabber.php'); 
// Define Currency/Commodity Symbols
define('BTCSYM','&#3647;');
define('NMCSYM','&#8469;');
define('GHSSYM','&#484;');
define('BF1SYM','&#9641;');
// Show Account name.
echo "CEX.IO Account info for " .USERNAME. "<br><br>";
// Show GHS the ticker.
if ($tickerGHSBTC->price->volume> 0){
	echo "" .GHSSYM. " Price in " .BTCSYM. ": <br>";
	echo "High Price: ";
	echo $tickerGHSBTC->price->high;
	echo "<br>Last Price: ";
	echo $tickerGHSBTC->price->last;
	echo "<br>Low Price: ";
	echo $tickerGHSBTC->price->low;
	echo "<br><br>Volume: ";
	echo $tickerGHSBTC->price->volume;
	echo "<br>Bid: ";
	echo $tickerGHSBTC->price->bid;
	echo "<br>Ask: ";
	echo $tickerGHSBTC->price->ask;
}
if ($tickerNMCBTC->price->volume> 0){
	echo "<br><br>" .NMCSYM. " Price in " .BTCSYM. ": <br>";
	echo "High Price: ";
	echo $tickerNMCBTC->price->high;
	echo "<br>Last Price: ";
	echo $tickerNMCBTC->price->last;
	echo "<br>Low Price: ";
	echo $tickerNMCBTC->price->low;
	echo "<br><br>Volume: ";
	echo $tickerNMCBTC->price->volume;
	echo "<br>Bid: ";
	echo $tickerNMCBTC->price->bid;
	echo "<br>Ask: ";
	echo $tickerNMCBTC->price->ask;
}
if ($tickerGHSNMC->price->volume> 0){
	echo "<br><br>" .GHSSYM. " Price in " .NMCSYM. ": <br>";
	echo "High Price: ";
	echo $tickerGHSNMC->price->high;
	echo "<br>Last Price: ";
	echo $tickerGHSNMC->price->last;
	echo "<br>Low Price: ";
	echo $tickerGHSNMC->price->low;
	echo "<br><br>Volume: ";
	echo $tickerGHSNMC->price->volume;
	echo "<br>Bid: ";
	echo $tickerGHSNMC->price->bid;
	echo "<br>Ask: ";
	echo $tickerGHSNMC->price->ask;
}
if ($tickerBF1BTC->price->volume> 0){
	echo "<br><br>" .BF1SYM. " Price in " .BTCSYM. ": <br>";
	echo "High Price: ";
	echo $tickerBF1BTC->price->high;
	echo "<br>Last Price: ";
	echo $tickerBF1BTC->price->last;
	echo "<br>Low Price: ";
	echo $tickerBF1BTC->price->low;
	echo "<br><br>Volume: ";
	echo $tickerBF1BTC->price->volume;
	echo "<br>Bid: ";
	echo $tickerBF1BTC->price->bid;
	echo "<br>Ask: ";
	echo $tickerBF1BTC->price->ask;
}
// Show balances.
if (isset($balance->timestamp)){
	$date = new DateTime("@$balance->timestamp");
	echo "<br><br>Date: " .$date->format('Y-m-d H:i:s') ."<br>";
}
if (isset($balance->btc->available)){
	if ($balance->btc->available> 0){
		// BTC Balance
		echo "<br>Bitcoins (" .BTCSYM. ") Available: <br>" .$balance->btc->available. " " .BTCSYM. "<br>";
	}
}
if (isset($balance->btc->orders)){
	if ($balance->btc->orders> 0){
		// BTC Balance on Orders
		echo "<br>Bitcoins (" .BTCSYM. ") in Orders: <br>" .$balance->btc->orders. " " .BTCSYM. "<br>";
		// Total BTC Owned
		echo "<br>Total Bitcoins (" .BTCSYM. ") on Account: <br>" .$balance->btc->total. " " .BTCSYM. "<br>";
	}
}
if (isset($balance->nmc->available)){
	if ($balance->nmc->available> 0){
		// NMC Balance
		echo "<br>Namecoins (" .NMCSYM. ") Available: <br>" .$balance->nmc->available. " " .NMCSYM. "<br>";
	}
}
if (isset($balance->nmc->orders)){
	if ($balance->nmc->orders> 0){
		// NMC Balance on Orders
		echo "<br>Namecoins (" .NMCSYM. ") in Orders: <br>" .$balance->nmc->orders. " " .NMCSYM. "<br>";
		// Total NMC Owned
		echo "<br>Total Namecoins (" .NMCSYM. ") on Account: <br>" .$balance->nmc->total. " " .NMCSYM. "<br>";
	}
}
if (isset($balance->ghs->available)){
	if ($balance->ghs->available> 0){
		// GHS on Stock
		echo "<br>Gigahash (" .GHSSYM. ") Available: <br>" .$balance->ghs->available. " " .GHSSYM. "<br>";
	}
}
if (isset($balance->ghs->orders)){
	if ($balance->ghs->orders> 0){
		// GHS for Sale
		echo "<br>GigaHash (" .GHSSYM. ") for Sale: <br>" .$balance->ghs->orders. " " .GHSSYM. "<br>";
		// Total GHS Owned
		echo "<br>Total GigaHash (" .GHSSYM. ") on Account: <br>" .$balance->ghs->total. " " .GHSSYM. "<br>";
	}
}
if (isset($balance->bf1->available)){
	if ($balance->bf1->available> 0){
		// BF1 on Stock
		echo "<br>Bitfuryh (" .BF1SYM. ") Available: <br>" .$balance->bf1->available. " " .BF1SYM. "<br>";
	}
}
if (isset($balance->bf1->orders)){
	if ($balance->bf1->orders> 0){
		// BF1 for Sale
		echo "<br>Bitfury (" .BF1SYM. ") for Sale: <br>" .$balance->bf1->orders. " " .BF1SYM. "<br>";
		// Total BF1 Owned
		echo "<br>Total Bitfury (" .BF1SYM. ") on Account: <br>" .$balance->bf1->total. " " .BF1SYM. "<br>";
	}
}
//
// More stuff to be added...
?>