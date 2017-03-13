<?php

return [
    'IRR' => [
        'luxury' => [
            'entry'          => 5000,
            'surcharge'      => [
                'thu'  =>  [
                    [
                       'from'  => '00:00',
                       'to'    => '3:00',
                       'amount' => 1.1,
                    ], [
                       'from'   => '3:00',
                       'to'     => '6:00',
                       'amount' => 1.5,
                    ],
                ],
            ],
            'perـdistance'   => 500,
            'perـtime'       => 0,
            // minute
            // hour
            'timeـunit'      => 'minute',
            // kilometer
            // mile
            'distanceـunit'  => 'kilometer',
        ],
        'van'   => [
            'entry'          => 5000,
            'surcharge'      => 0,
            'perـdistance'   => 500,
            'perـtime'       => 0,
            'timeـunit'      => 'minute',
            'distanceـunit'  => 'kilometer',
        ],
        'sport'      => [
            'entry'          => 5000,
            'surcharge'      => 0,
            'perـdistance'   => 500,
            'perـtime'       => 0,
            'timeـunit'      => 'minute',
            'distanceـunit'  => 'kilometer',
        ],
        'sedans'  => [
            'entry'          => 5000,
            'surcharge'      => 0,
            'perـdistance'   => 500,
            'perـtime'       => 0,
            'timeـunit'      => 'minute',
            'distanceـunit'  => 'kilometer',
        ],
        'economy'  => [
            'entry'          => 5000,
            'surcharge'      => 0,
            'perـdistance'   => 500,
            'perـtime'       => 0,
            'timeـunit'      => 'minute',
            'distanceـunit'  => 'kilometer',
        ],
        'off-roader'  => [
            'entry'          => 5000,
            'surcharge'      => 0,
            'perـdistance'   => 500,
            'perـtime'       => 0,
            'timeـunit'      => 'minute',
            'distanceـunit'  => 'kilometer',
        ],
        'motorcycle'  => [
            'entry'          => 5000,
            'surcharge'      => 0,
            'perـdistance'   => 500,
            'perـtime'       => 0,
            'timeـunit'      => 'minute',
            'distanceـunit'  => 'kilometer',
        ],
    ]
];
