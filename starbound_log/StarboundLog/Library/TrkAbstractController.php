<?php

namespace StarboundLog\Library;


use StarboundLog\Library\Menu\Item;
use StarboundLog\Model\ViewData;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class TrkAbstractController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $result = parent::onDispatch($e);
        ViewData::$menuItems = $this->_getMenu();
        return $result;
    }

    /**
     * @return Item[]
     */
    protected function _getMenu()
    {
        return array(
            new Item('/', 'plus', 'Add planet'),
            new Item('/', 'rocket', 'Record my visit'),
            new Item('/', 'globe', 'My planets'),
            new Item('/', 'planet', 'All planets'),
            new Item('/', 'users', 'My characters'),
            new Item('/', 'add-contact', 'Register'),
            new Item('/', 'key-2', 'Log in'),
            new Item('/', 'off', 'Log off'),
        );
    }
} 