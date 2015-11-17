<?php
return [
    'view_manager'    => [
        'template_path_stack' => [
            'soliant-jira-issue-collector' => __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Soliant\JiraIssueCollector\Options::class => \Soliant\JiraIssueCollector\Factory\OptionsFactory::class,
            \Soliant\JiraIssueCollector\Listener::class =>
                \Soliant\JiraIssueCollector\Factory\ListenerFactory::class
            ,
        ],
    ],
];
