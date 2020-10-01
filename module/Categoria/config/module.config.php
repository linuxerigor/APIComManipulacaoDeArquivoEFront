<?php
namespace Categoria;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\CategoriaController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'categoria' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/categoria[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        // 'template_path_stack' => [
        //     'categoria' => __DIR__ . '/../view',
        // ],
        'strategies' => [
            'ViewJsonStrategy'
        ],
    ],
];