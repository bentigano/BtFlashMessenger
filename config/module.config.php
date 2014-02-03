<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'fm' => 'BtFlashMessenger\Controller\Plugin\BtFlashMessenger',
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            'fm' => 'BtFlashMessenger\View\Helper\BtFlashMessenger',
        )
    ),
);