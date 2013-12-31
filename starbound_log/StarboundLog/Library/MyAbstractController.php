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
    }
}