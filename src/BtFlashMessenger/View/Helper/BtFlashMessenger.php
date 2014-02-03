<?php
namespace BtFlashMessenger\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;

class BtFlashMessenger extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected $renderer = null;
    protected $namespaces = array(
        'success',
        'info',
        'warning',
        'danger',
    );

    public function __invoke($namespace = null)
    {
        $messageOutput = '';
        $fm = new \Zend\Mvc\Controller\Plugin\FlashMessenger;
        $namespaces = $this->namespaces;

        if (!is_null($namespace)) {
            if (!is_array($namespace)) {
                $namespaces = array($namespace);     
            } else {
                $namespaces = $namespace;
            }
        }

        foreach ($namespaces as $ns) {
            // merge current and past messages
            $fm->setNamespace($ns);
            $messages = array_merge(
                $fm->getMessages(),
                $fm->getCurrentMessages()
            );
            
            // no messages to display for this namespace
            if (empty($messages)) {
                continue;
            }

            $viewModel = new ViewModel(array(
                'namespace' => $ns,
                'messages' => implode('<br />', $messages)
            ));

            $viewModel->setTemplate('flash-messenger/alert.phtml');

            $messageOutput .= $this->getRenderer()->render($viewModel);
        }

        return $messageOutput;
    }

    protected function getRenderer()
    {
        if (is_null($this->renderer)) {
            $stack = new TemplatePathStack();
            $resolver = new AggregateResolver();
            $renderer = new PhpRenderer();
            
            $config = $this->getServiceLocator()->get('Config');
            foreach($config['view_manager']["template_path_stack"] as $path) {
                $stack->addPath($path);
            }

            $resolver->attach($stack);
            $renderer->setResolver($resolver);
            $this->renderer = $renderer;
        }

        return $this->renderer;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator->getServiceLocator();
    }
}
