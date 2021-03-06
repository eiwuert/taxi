<?php

return [
    // 'client_server_key' => env('FCM_CLIENT_SERVER_KEY', 'Your FCM server key'),
    // 'client_sender_id'  => env('FCM_CLIENT_SENDER_ID', 'Your sender id'),
    // 'driver_server_key' => env('FCM_DRIVER_SERVER_KEY', 'Your FCM server key'),
    // 'driver_sender_id'  => env('FCM_DRIVER_SENDER_ID', 'Your sender id'),
    'server_key'        => env('SERVER_KEY', 'Your FCM server key'),
    'sender_id'         => env('SENDER_ID', 'Your sender id'),
    'send_url'          => 'https://fcm.googleapis.com/fcm/send',
    'group_url'         => 'https://android.googleapis.com/gcm/notification',
    'timeout'           => 40.0, // in second (default four weeks)
    'priority'          => 'high', // or normal (default is normal)
];
