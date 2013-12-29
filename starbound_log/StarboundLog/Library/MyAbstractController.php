<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 29.12.13
 * Time: 03:02
 */

namespace StarboundLog\Library;


use StarboundLog\Model\ViewData;
use StarboundLog\Model\ViewData\Menu\Item;
use Trks\TrksAbstractController;
use Zend\View\Model\ViewModel;

class MyAbstractController extends TrksAbstractController
{

    protected function createViewData(ViewModel $viewData)
    {
        ViewData::$menuItems = $this->_getMenu();
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