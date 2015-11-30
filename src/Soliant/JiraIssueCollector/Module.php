<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\JiraIssueCollector
 * @copyright Copyright (c) 2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\JiraIssueCollector;

use Zend\EventManager\EventInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements
    ConfigProviderInterface,
    BootstrapListenerInterface
{
    /**
     * @param  MvcEvent $event
     * @throws Exception\InvalidOptionException
     */
    public function onBootstrap(EventInterface $event)
    {
        if (PHP_SAPI === 'cli') {
            return;
        }

        $application = $event->getApplication();
        $eventManager = $application->getEventManager();
        // $sharedManager  = $eventManager->getSharedManager();
        $serviceManager = $application->getServiceManager();

        /** @var Options $options */
        $options = $serviceManager->get(Options::class);

        if (!$options->isEnabled()) {
            return;
        }

        /** @var ListenerAggregateInterface $listener */
        $listener = $serviceManager->get(Listener::class);
        $eventManager->attachAggregate($listener);
    }

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }
}
