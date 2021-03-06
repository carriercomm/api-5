<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Synchronized
	|--------------------------------------------------------------------------
	| If set, the API will call the worker directly, instead of using a jobserver.
	*/
	
	'synchronized' => false,
	
	/*
	|--------------------------------------------------------------------------
	| Engine path
	|--------------------------------------------------------------------------
	| This path is used by the local Jobserver to sync a queue request.
	*/
	'engine' => array(
	
		'workerpath' => '/home/psilva/websites/cloudwalkers-engine.local/'
	)
);