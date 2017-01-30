<?php

return [
	/**
	 * Default SMS sender
	 * options: plivo, ir
	 */
	'default' => env('SMS', 'plivo'),

	/**
	 * plivo config
	 */
	'plivo' => [	
		'auth_id' 	 => env('SMS_PLIVO_AUTH_ID'),
		'auth_token' => env('SMS_PLIVO_AUTH_TOKEN'),
		'from'	  	 => env('SMS_PLIVO_SRC'),
		'url'		 => 'https://api.plivo.com/v1/',
	],

	/**
	 * SMS.ir config
	 */
	'ir' => [
		'url'		 => 'http://ip.sms.ir/ws/SendReceive.asmx?wsdl',
		'userName'   => env('SMS_IR_USERNAME'),
		'password'   => env('SMS_IR_PASSWORD'),
		'lineNumber' => env('SMS_IR_LINENUMBER'),
	],
	
	/**
	 * Options: random_int, plain
	 * random_int: 5 digits
	 * plain:      55555
	 */
	'code'		 => env('SMS_CODE', 'plain'),
];
