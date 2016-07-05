<?php
$cookiefile = '/coo.txt';  //+рандомхэш куки для сессии

require_once curl.php;

require requests/hh.php;
require requests/superjob.php;
require requests/avito.php;
require requests/rabota.php;

unlink(dirname(__FILE__).$cookiefile);