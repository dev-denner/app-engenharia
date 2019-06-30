<?php
return [
    'settings' => [
        'displayErrorDetails' => getenv('DEBUG'),
        'addContentLengthHeader' => false,
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
        'logger' => [
            'name' => 'Waste Online',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/' . date('Y-m-d') . '.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'viewCache'              => __DIR__ . '/../cache/',
    ],
];