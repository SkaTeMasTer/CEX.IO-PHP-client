<?php
/*
 * CEX.IO - Bitcoin 
 *
 * Query Balance
 *
 * LIMITS: "Do not make more than 600 request per 10 minutes or we will ban your IP address."  If you want more, add a list of proxy servers to CURL.
 *
 * Oct 27, 2013 - They just released their API access last week, so I thought a seed to get some bots started...  -Shawn Reimerdes
 *
 * Query Ticker
 * Nov 13, 2013 - Added some objects to the library to clean up the mess, added ticker...  -Davy Moedbeck - A.k.a. MasterX1582
 *
 * This sample is made available by Shawn Reimerdes and moddified by MasterX1582.
 * If this is usefull for you, feel free to support me by sending some bitcoins to 1MegaXG1bd6mTEQCdAMjVzGexcYrF5LJKv
 * The writers of this peace of code can absolutely not be held responsible by any losses made by use of this piece of code. 
 * You are the only person totaly responsible for running this software.
 * 
 * Enjoy!
 * MasterX1582
 *
 * https://www.cex.io/api
*/

define('VERSION','0.10.2 beta');
// ___________________________________________________________________________________________ ____________ _ ___ _ __  _  .
function cexio_query($path, array $req = array()) {

	$mt = explode(' ', microtime());
 
        $sign = strtoupper(hash_hmac("sha256", $mt[1] . USERNAME . KEY, SECRET));
       
        $req['key'] = KEY;
        $req['signature'] = $sign;
        $req['nonce'] = $mt[1];
       
        # generate the POST data string
        $post_data = http_build_query($req, '', '&');
 
        # generate the extra headers
        $headers = array(
                'key: '.$req['key'],
                'signature: '.$sign,
                'nonce:'.$mt[1]
        );
	
	
	// our curl handle (initialize if required)
	static $ch = null;
	if (is_null($ch)) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; CEX.IO PHP client v'. VERSION .'; '.php_uname('s').'; PHP/'.phpversion().')');
	}
	curl_setopt($ch, CURLOPT_URL, $path);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
	// run the query
	$res = curl_exec($ch);
	if ($res === false) throw new Exception('Could not get reply: '.curl_error($ch));
	$dec = json_decode($res, true);
	if (!$dec) throw new Exception('Invalid data received, please make sure connection is working and requested API exists');
	return $dec;
}

define('APIURL', 'https://cex.io/api');
$tickerGHSBTC = cexio_query(APIURL. '/ticker/GHS/BTC');
$tickerGHSBTC = (object) array(
	 'price' => (object) array(
		  'high' => $tickerGHSBTC['high'],
		  'low' => $tickerGHSBTC['low'],
		  'last' => $tickerGHSBTC['last'],
		  'volume' => $tickerGHSBTC['volume'],
		  'bid' => $tickerGHSBTC['bid'],
		  'ask' => $tickerGHSBTC['ask']
	  )
	);
$tickerNMCBTC = cexio_query(APIURL. '/ticker/NMC/BTC');
$tickerNMCBTC = (object) array(
	 'price' => (object) array(
		  'high' => $tickerNMCBTC['high'],
		  'low' => $tickerNMCBTC['low'],
		  'last' => $tickerNMCBTC['last'],
		  'volume' => $tickerNMCBTC['volume'],
		  'bid' => $tickerNMCBTC['bid'],
		  'ask' => $tickerNMCBTC['ask']
	  )
	);
$tickerGHSNMC = cexio_query(APIURL. '/ticker/GHS/NMC');
$tickerGHSNMC = (object) array(
	 'price' => (object) array(
		  'high' => $tickerGHSNMC['high'],
		  'low' => $tickerGHSNMC['low'],
		  'last' => $tickerGHSNMC['last'],
		  'volume' => $tickerGHSNMC['volume'],
		  'bid' => $tickerGHSNMC['bid'],
		  'ask' => $tickerGHSNMC['ask']
	  )
	);
$tickerBF1BTC = cexio_query(APIURL. '/ticker/BF1/BTC');
$tickerBF1BTC = (object) array(
	 'price' => (object) array(
		  'high' => $tickerBF1BTC['high'],
		  'low' => $tickerBF1BTC['low'],
		  'last' => $tickerBF1BTC['last'],
		  'volume' => $tickerBF1BTC['volume'],
		  'bid' => $tickerBF1BTC['bid'],
		  'ask' => $tickerBF1BTC['ask']
	  )
	);
$balance = cexio_query(APIURL. '/balance/');
$balance = (object) array(
	 'timestamp' => $balance['timestamp'],
	 'btc' => (object) array(
		  'available' => $balance['BTC']['available'],
		  'orders' => $balance['BTC']['orders'],
		  'total' => ($balance['BTC']['orders'] + $balance['BTC']['available'])
	  ),
	 'ghs' => (object) array(
		  'available' => $balance['GHS']['available'],
		  'orders' => $balance['GHS']['orders'],
		  'total' => ($balance['GHS']['orders'] + $balance['GHS']['available'])
	  ),
	 'nmc' => (object) array(
	 	  'available' => $balance['NMC']['available'],
	 	  'orders' => $balance['NMC']['orders'],
	 	  'total' => ($balance['NMC']['orders'] + $balance['NMC']['available'])
	 ),
	 'bf1' => (object) array(
	 	  'available' => $balance['BF1']['available'],
	 	  'orders' => $balance['BF1']['orders'],
	 	  'total' => ($balance['BF1']['orders'] + $balance['BF1']['available'])
	 )
	);
// ___________________________________________________________________________________________ ____________ _ ___ _ __  _  .

// example 1: get infos about the account, plus the list of rights we have access to
// var_dump(cexio_query('https://cex.io/api/balance/'));
 /* EXAMPLE OUTPUT:
  
  array(3) {
  ["timestamp"]=>
  string(10) "1382979452"
  ["BTC"]=>
  array(2) {
    ["available"]=>
    string(10) "1.41929714"
    ["orders"]=>
    string(10) "4.26658765"
  }
  ["GHS"]=>
  array(2) {
    ["available"]=>
    string(12) "194.25621640"
    ["orders"]=>
    string(10) "3.30000000"
  }
}

*/

// example 2: show ghs high price
// print $tickerGHS->price->high;
/* EXAMPLE OUTPUT:
 0.1014
*/

// example 3: show ghs last price
// print $tickerGHS->price->last;
/* EXAMPLE OUTPUT:
 0.1011
*/

// example 4: show ghs low price
// print $tickerGHS->price->low;
 /* EXAMPLE OUTPUT:
 0.108
*/

// example 5: show ghs balance
// print $balance->ghs->available;
/* EXAMPLE OUTPUT:
 194.25621640
*/

// example 6: show total ghs balance
// print $balance->ghs->total;
/* EXAMPLE OUTPUT:
 197.5562164
*/
?>
