<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\JiraIssueCollector
 * @copyright Copyright (c) 2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\JiraIssueCollector\Factory;

use Soliant\JiraIssueCollector\Options;
use Zend\Debug\Debug;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OptionsFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Options
     */
    public function createService(ServiceLocatorInterface $sm)
    {
        $config = $sm->get('Configuration');
        $config = isset($config['soliant-jira-issue-collector']) ? $config['soliant-jira-issue-collector'] : null;

        return new Options($config);
    }
}
