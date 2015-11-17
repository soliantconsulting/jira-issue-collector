<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\JiraIssueCollector
 * @copyright Copyright (c) 2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\JiraIssueCollector\Factory;

use Soliant\JiraIssueCollector\Listener;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListenerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Listener
     */
    public function createService(ServiceLocatorInterface $sm)
    {
        /** @var \Soliant\JiraIssueCollector\Options $options */
        $options = $sm->get(\Soliant\JiraIssueCollector\Options::class);

        /** @var \Zend\View\Renderer\PhpRenderer $viewRenderer */
        $viewRenderer = $sm->get(\Zend\View\Renderer\PhpRenderer::class);

        return new \Soliant\JiraIssueCollector\Listener($viewRenderer, $options);
    }
}
