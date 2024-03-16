<?php

use AndreasNik\Ticket\Tests\Models\Affiliate;
use AndreasNik\Ticket\Tests\Models\Client;
use Tests\Models\User;

return [



    /**
     * ticket settings table
     */
    'settings' => 'ticket_settings',

    /**
     * ticket assignment settings table
     */
    'assignment_settings' => 'ticket_assignment_settings',


    /**
     * ticket table
     */
    'table' => 'tickets',

    /**
     * ticket category table
     */
    'category' => 'ticket_categories',

    /**
     * ticket category content table
     */
    'category_content' => 'ticket_categories_content',

    /**
     * ticket feedback table
     */
    'feedback' => 'ticket_feedback',

    /**
     * ticket reply template table
     */
    'reply_template' => 'ticket_reply_templates',

    /**
     * ticket reply template content table
     */
    'reply_template_content' => 'ticket_reply_templates_content',

    /**
     * ticket responses table
     */
    'responses' => 'ticket_responses',

    /**
     * ticket attachments table
     */
    'attachments' => [
        'table' => 'ticket_attachments',
        'upload_disk' => 'local',
    ],


    /**
     * name of the timestamps columns for the tables
     */
    'timestamps' => [
        'created' => 'created_on',
        'updated' => 'modified_on',
        'deleted' => 'deleted_on',
    ],

    /**
     * system entities
     * add other entities except the `user`
     */
    'entities' => [
        'client',
        'affiliate'
    ],

    /**
     * priorities
     */
    'priorities' => [
        'low',
        'normal',
        'high',
        'critical'
    ],


    'relationships' => [
        'ticket' => [
            'client' => [
                'model' => Client::class,
                'foreignKey' => null,
                'ownerKey' => null,
            ],
            'affiliate' => [
                'model' => Affiliate::class,
                'foreignKey' => null,
                'ownerKey' => null,
            ],
            'user' => [
                'model' => User::class,
                'foreignKey' => null,
                'ownerKey' => null,
            ],
        ],
    ]
];