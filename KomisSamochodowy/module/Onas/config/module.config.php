<?php
namespace Onas;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],    
    ],    
    
    'router' => [
        'routes' => [
            'o-nas' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/o-nas[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],    
        ],    
    ],    
        
    'view_manager' => [
        'template_path_stack' => [
            'o-nas' => __DIR__ . '/../view',    
        ],    
    ],
];