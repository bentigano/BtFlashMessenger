<?php
namespace BtFlashMessenger\Controller\Plugin;

class BtFlashMessenger extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
{
	private $_fm;
	
    public function __invoke($message, $namespace = 'success')
    {
		if (is_null($this->_fm))
		{
			$this->_fm = new \Zend\Mvc\Controller\Plugin\FlashMessenger();
		}
		
        $this->_fm->setNamespace($namespace);

        if (is_array($message)) {
            foreach ($message as $msg) {
                $this->_fm->addMessage($msg);
            }
        } else {
            $this->_fm->addMessage($message);
        }

        return $this->_fm;
    }
}