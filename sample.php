<?php
require_once('r1soft/r1soft.php');

//Connect to the server and create the soap object when called
//You can also add ssl=False or port=1234 to change defaults
$client = new cdp3('server.server.com','admin','password');
 
foreach ($client->Policy2->getPolicyIDs()->return as $tmp) {
    print $tmp . "\n";
}
