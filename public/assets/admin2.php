<?php

$data = [
    'current_level' => 458,

    'user_levels'   =>  [
        [
            'tag'       =>  '0x8D 0xFD 0x72 0x30',
            'litres'    =>  254
        ],

        [
            'tag'       =>  '0x8D 0xFD 0x72 0x40',
            'litres'    =>  9000
        ],
    ]
];

echo json_encode($data);