<?php

return [
    'router' => [
        'routes' => [
            'eye4web_zfcuser_warnings' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/user/warnings',
                    'defaults' => [
                        'controller' => 'Eye4web\ZfcUser\Warnings\Controller\WarningsController',
                        'action'     => 'userWarnings',
                    ],
                ],
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            'Eye4web\ZfcUser\Warnings\Mapper' => 'Eye4web\ZfcUser\Warnings\Factory\Mapper\DoctrineORMMapperFactory',
            'Eye4web\ZfcUser\Warnings\Service\WarningsService' => 'Eye4web\ZfcUser\Warnings\Factory\Service\WarningsServiceFactory',
        ],
    ],
    'controllers' => [
        'factories' => [
            'Eye4web\ZfcUser\Warnings\Controller\WarningsController' => 'Eye4web\ZfcUser\Warnings\Factory\Controller\WarningsControllerFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../views',
        ]
    ],
    'view_helpers' => [
        'factories' => [
            'ZfcUserDisplayNameByUserId' => 'Eye4web\ZfcUser\Warnings\Factory\View\Helper\ZfcUserDisplayNameByUserIdFactory'
        ],
    ],
    'doctrine' => array(
        'driver' => array(
            'eye4webzfcuserwarnings_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/doctrine_xml/eye4web/zfcuser/warnings'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Eye4web\ZfcUser\Warnings\Entity'  => 'eye4webzfcuserwarnings_entity'
                )
            )
        )
    ),
];
