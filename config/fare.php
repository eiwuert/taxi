<?php

return [
    'USD' => [
        'luxury' => [
            'entry'          => 2.0,
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
            'perـdistance'   => 0.7,
            'perـtime'       => 0.3,
            // minute
            // hour
            'timeـunit'      => 'minute',
            // kilometer
            // mile
            'distanceـunit'  => 'kilometer',
        ],
        'van'   => [
            'entry'          => 0,
            'surcharge'      => 0,
            'perـdistance'   => 0,
            'perـtime'       => 0,
            'timeـunit'      => 0,
            'distanceـunit'  => 0,
        ],
        'sport'      => [
            'entry'          => 0,
            'surcharge'      => 0,
            'perـdistance'   => 0,
            'perـtime'       => 0,
            'timeـunit'      => 0,
            'distanceـunit'  => 0,
        ],
        'sedans'  => [
            'entry'          => 0,
            'surcharge'      => 0,
            'perـdistance'   => 0,
            'perـtime'       => 0,
            'timeـunit'      => 0,
            'distanceـunit'  => 0,
        ],
        'economy'  => [
            'entry'          => 0,
            'surcharge'      => 0,
            'perـdistance'   => 0,
            'perـtime'       => 0,
            'timeـunit'      => 0,
            'distanceـunit'  => 0,
        ],
        'off-roader'  => [
            'entry'          => 0,
            'surcharge'      => 0,
            'perـdistance'   => 0,
            'perـtime'       => 0,
            'timeـunit'      => 0,
            'distanceـunit'  => 0,
        ],
        'motorcycle'  => [
            'entry'          => 0,
            'surcharge'      => 0,
            'perـdistance'   => 0,
            'perـtime'       => 0,
            'timeـunit'      => 0,
            'distanceـunit'  => 0,
        ],
    ]
];
