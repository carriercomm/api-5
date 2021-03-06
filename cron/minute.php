<?php

error_reporting (E_ALL);
ini_set('display_errors', true);

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';
$app = require_once __DIR__.'/../bootstrap/start.php';

$client = new GearmanClient ();

foreach (Config::get ('gearman.servers') as $server => $port)
{
	$client->addServer ($server, $port);
}

$data = $client->doHigh ('cron1', "cron1");


/**
 *	Scheduler
 *	The new gearman scheduler cron (v1.1 only)
 *
 *	The loaded file should replace this one later on.
 */
include_once __DIR__.'/../gearman-cron/schedule.php';