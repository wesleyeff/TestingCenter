<?php

//namespace Appointment;

return array(
    'controllers' => array(
        'invokables' => array(
            'Appointment\Controller\Appointment' => 'Appointment\Controller\AppointmentController',
            'Appointment\Controller\User' => 'Appointment\Controller\UserController',
            'Appointment\Controller\Exam' => 'Appointment\Controller\ExamController',
            'Appointment\Controller\Rest' => 'Appointment\Controller\RestController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'appointment' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/appointment[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Appointment\Controller\Appointment',
                        'action'     => 'index',
                    ),
                ),
            ),
            'user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/user[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Appointment\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),
            'exam' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/exam[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Appointment\Controller\Exam',
                        'action'     => 'index',
                    ),
                ),
            ),
            'rest' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/rest',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Appointment\Controller',
                    ),
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/:controller[/:id][/]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => null,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Appointment' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);