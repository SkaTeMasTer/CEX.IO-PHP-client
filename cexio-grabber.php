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
 * https://www.cex.io/api
*/

define('VERSION','0.10.1 beta');
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

define('URL', 'https://cex.io/api');
$tickerGHS = cexio_query(URL. '/ticker/GHS/BTC');
$tickerGHS = (object) array(
	 'price' => (object) array(
		  'high' => $tickerGHS['high'],
		  'low' => $tickerGHS['low'],
		  'last' => $tickerGHS['last']
	  )
	);
$tickerBF1 = cexio_query(URL. '/ticker/BF1/BTC');
$tickerBF1 = (object) array(
	 'price' => (object) array(
		  'high' => $tickerBF1['high'],
		  'low' => $tickerBF1['low'],
		  'last' => $tickerBF1['last']
	  )
	);
$balance = cexio_query(URL. '/balance/');
$balance = (object) array(
	 'btc' => (object) array(
		  'available' => $balance['BTC']['available'],
		  'orders' => $balance['BTC']['orders'],
		  'total' => ($balance['BTC']['orders'] + $balance['BTC']['available'])
	  ),
	 'ghs' => (object) array(
		  'available' => $balance['GHS']['available'],
		  'orders' => $balance['GHS']['orders'],
		  'total' => ($balance['GHS']['orders'] + $balance['GHS']['available'])
	  )#,
	 #'bf1' => (object) array(
	 #	  'available' => $balance['BF1']['available'],
	 #	  'orders' => $balance['BF1']['orders'],
	 #	  'total' => ($balance['BF1']['orders'] + $balance['BF1']['available'])
	 #)
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
/* EXAMPLE OUTPUT:
 print $tickerGHS->price->high;
*/

// example 3: show ghs last price
/* EXAMPLE OUTPUT:
 print $tickerGHS->price->last;
*/

// example 4: show ghs low price
 /* EXAMPLE OUTPUT:
 print $tickerGHS->price->low;
*/

// example 5: show ghs balance
/* EXAMPLE OUTPUT:
 print $balance->ghs->available;
*/
?>
