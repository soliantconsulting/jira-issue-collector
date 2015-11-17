<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\JiraIssueCollector
 * @copyright Copyright (c) 2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\JiraIssueCollector;

use Soliant\JiraIssueCollector\Exception\InvalidOptionException;
use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    protected $enabled = false;
    protected $useJquery = true;
    protected $url = null;
    protected $clickSelector = null;
    protected $scriptTemplatePath = null;
    protected $divTemplatePath = null;
    protected $cssTemplatePath = null;

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool)$enabled;
    }

    /**
     * @param array $collector
     */
    public function setCollector(array $collector)
    {
        if (isset($collector['useJquery'])) {
            $this->useJquery = (bool)$collector['useJquery'];
        }
        if (isset($collector['url'])) {
            $this->url = $collector['url'];
        } else {
            throw new InvalidOptionException(
                "\$config['soliant-jira-issue-collector']['collector']['url'] is missing."
            );
        }
    }

    /**
     * @param string $clickSelector
     */
    public function setClickSelector($clickSelector)
    {
        $this->clickSelector = $clickSelector;
    }

    /**
     * @param array $templatePath
     */
    public function setTemplatePath(array $templatePath)
    {
        if (isset($templatePath['script'])) {
            $this->scriptTemplatePath = $templatePath['script'];
        }
        if (isset($templatePath['div'])) {
            $this->divTemplatePath = $templatePath['div'];
        }
        if (isset($templatePath['css'])) {
            $this->cssTemplatePath = $templatePath['css'];
        }
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return boolean
     */
    public function isUseJquery()
    {
        return $this->useJquery;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return null|string
     */
    public function getClickSelector()
    {
        return $this->clickSelector;
    }

    /**
     * @return null|string
     */
    public function getScriptTemplatePath()
    {
        return $this->scriptTemplatePath;
    }

    /**
     * @return null|string
     */
    public function getDivTemplatePath()
    {
        return $this->divTemplatePath;
    }

    /**
     * @return null|string
     */
    public function getCssTemplatePath()
    {
        return $this->cssTemplatePath;
    }
}
