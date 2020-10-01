<?php
namespace Categoria;

use Zend\Router\Http\Literal;
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
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'categoria' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/categoria[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'search' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/search/:q',
                    'constraints' => [
                        'q' => '.*'
                    ],
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'search',
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