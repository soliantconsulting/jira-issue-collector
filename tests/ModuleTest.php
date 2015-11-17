<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\JiraIssueCollector
 * @copyright Copyright (c) 2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\JiraIssueCollectorTest;

use PHPUnit_Framework_TestCase;
use Soliant\JiraIssueCollector\Module;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testGetConfig()
    {
        $module = new Module();
        $config = $module->getConfig();

        $this->assertInternalType('array', $config);
        $this->assertSame($config, unserialize(serialize($config)));
    }
}
