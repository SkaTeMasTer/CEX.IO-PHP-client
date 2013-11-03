<?php 
include('config.inc.php');
include('cexio-grabber.php'); 

$balance = json_encode(cexio_query('https://cex.io/api/balance/'));
$balance_o = json_decode($balance,true);

if ($balance_o['BTC']['available']> 0){
	echo "Bitcoins Available: <br>";
	print $balance_o['BTC']['available'];
	echo " &#3647;";
}

if ($balance_o['BTC']['orders']> 0){
	echo "<br>";
	echo "<br>";
	echo "GigaHash for Sale: <br>";
	print $balance_o['BTC']['orders'];
	echo " &#3647;";
}

if ($balance_o['GHS']['available']> 0){
	echo "<br>";
	echo "<br>";
	echo "Gigahash Available: <br>";
	print $balance_o['GHS']['available'];
	echo " GHS";
}

if ($balance_o['GHS']['orders']> 0){
	echo "<br>";
	echo "<br>";
	echo "Gigahash Ordered: <br>";
	print $balance_o['GHS']['orders'];
	echo " GHS";
}
?>
