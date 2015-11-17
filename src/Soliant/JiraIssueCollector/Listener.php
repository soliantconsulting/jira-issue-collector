<?php
/**
 * This source file is subject to the MIT license that is bundled with this package in the file LICENSE.txt.
 *
 * @package   Soliant\JiraIssueCollector
 * @copyright Copyright (c) 2015 Soliant Consulting, Inc. (http://www.soliantconsulting.com)
 * @author    jsmall@soliantconsulting.com
 */

namespace Soliant\JiraIssueCollector;

use Zend\Debug\Debug;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

class Listener implements ListenerAggregateInterface
{
    /**
     * @var object
     */
    protected $renderer;

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * Constructor.
     *
     * @param PhpRenderer $viewRenderer
     * @param Options $options
     */
    public function __construct(PhpRenderer $viewRenderer, Options $options)
    {
        $this->options = $options;
        $this->renderer = $viewRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_FINISH,
            [$this, 'onMvcEventFinish']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @param MvcEvent $event
     */
    public function onMvcEventFinish(MvcEvent $event)
    {
        $application = $event->getApplication();
        $request = $application->getRequest();

        if ($request->isXmlHttpRequest()) {
            return;
        }

        $response = $application->getResponse();
        $headers = $response->getHeaders();
        if ($headers->has('Content-Type')
            && false === strpos($headers->get('Content-Type')->getFieldValue(), 'html')
        ) {
            return;
        }

        $this->injectCollector($event);
    }

    /**
     * Tries to injects the snippet into the view. The snippet is only injected in well
     * formed HTML by replacing the closing body tag, leaving ESI untouched.
     * (See https://en.wikipedia.org/wiki/Edge_Side_Includes)
     *
     * @param MvcEvent $event
     */
    protected function injectCollector(MvcEvent $event)
    {

        /** @var \Zend\Http\PhpEnvironment\Response $response */
        $response = $event->getApplication()->getResponse();

        /**
         * Setup the div snippet
         */
        $collectorDiv = new ViewModel([
            'clickSelector' => $this->options->getClickSelector(),
        ]);
        if ($this->options->getDivTemplatePath()) {
            $collectorDiv->setTemplate($this->options->getDivTemplatePath());
        } else {
            $collectorDiv->setTemplate('soliant-jira-issue-collector/snippet/div');
        }
        $div = $this->renderer->render($collectorDiv);

        /**
         * Setup the css snippet
         */
        $collectorCss = new ViewModel([
            'clickSelector' => $this->options->getClickSelector(),
        ]);
        if ($this->options->getCssTemplatePath()) {
            $collectorCss->setTemplate($this->options->getCssTemplatePath());
        } else {
            $collectorCss->setTemplate('soliant-jira-issue-collector/snippet/style');
        }
        $style = $this->renderer->render($collectorCss);

        /**
         * Setup the script snippet
         */
        $collectorScript = new ViewModel([
            'url' => $this->options->getUrl(),
            'useJquery' => $this->options->isUseJquery(),
            'clickSelector' => $this->options->getClickSelector(),
        ]);
        if ($this->options->getScriptTemplatePath()) {
            $collectorScript->setTemplate($this->options->getScriptTemplatePath());
        } else {
            $collectorScript->setTemplate('soliant-jira-issue-collector/snippet/script');
        }
        $script = $this->renderer->render($collectorScript);

        /**
         * Inject the snippets into the Response body
         */
        $injected = $response->getBody();
        if ($this->options->getDivTemplatePath()) {
            $injected = preg_replace('/<\/body>(?![\s\S]*<\/body>)/i', $div . "\n</body>", $injected, 1);
        }
        if ($this->options->getCssTemplatePath()) {
            $injected = preg_replace('/<\/head>/i', $style . "\n</head>", $injected, 1);
        }
        $injected = preg_replace('/<\/body>(?![\s\S]*<\/body>)/i', $script . "\n</body>", $injected, 1);

        $response->setContent($injected);
    }
}
