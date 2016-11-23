<?php

return [
	'auth_id' 	 => env('SMS_AUTH_ID'),
	'auth_token' => env('SMS_AUTH_TOKEN'),
	'from'	  	 => env('SMS_SRC'),
	'url'		 => 'https://api.plivo.com/v1/',
];
