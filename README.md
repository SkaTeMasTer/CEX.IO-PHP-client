CEX.IO PHP client for Trader API
================================

\`sexy-oh`\

API Docs: https://www.cex.io/api

Request limits: "Do not make more than 600 request per 10 minutes or we will ban your IP address."


Public Functions (no logon required)

+ Ticker
GET https://cex.io/api/ticker/GHS/BTC

+ Order book
GET https://cex.io/api/order_book/GHS/BTC

+ Trade history
GET https://cex.io/api/trade_history/GHS/BTC

----

Private Function (API key & access required)

+ Account balance
POST https://cex.io/api/balance/

+ Open orders
POST https://cex.io/api/open_orders/GHS/BTC

+ Cancel order
POST https://cex.io/api/cancel_order/

+ Place order
POST https://cex.io/api/place_order/GHS/BTC





Note: you must logon to http://www.cex.io/ and go to your account / security and explicitly enable a new API key.

You will need as input for private functions:
+ Username
+ API key
+ API secret key


API access is achieved with basic seeded Signature which is a HMAC-SHA256 encoded message containing: nonce, client ID and API key. The HMAC-SHA256 code must be generated using a secret key that was generated with your API key.
