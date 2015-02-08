<?php

//namespace Appointment;

return array(
    'controllers' => array(
        'invokables' => array(
            'Appointment\Controller\Appointment' => 'Appointment\Controller\AppointmentController',
            'Appointment\Controller\User' => 'Appointment\Controller\UserController',
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
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Appointment' => __DIR__ . '/../view',
        ),
    ),
);