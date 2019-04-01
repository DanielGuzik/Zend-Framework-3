<?php

namespace Komis;

use Zend\Router\Http\Segment;

return [
    'Zend\Db',
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'komis' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/komis[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\KomisController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'komis' => __DIR__ . '/../view',
        ],
    ],
];
