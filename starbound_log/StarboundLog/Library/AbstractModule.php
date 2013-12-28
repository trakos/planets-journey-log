<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 17.12.13
 * Time: 12:31
 * To change this template use File | Settings | File Templates.
 */

namespace StarboundLog\Library;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\View\Http\InjectTemplateListener;
use Zend\View\Model\ViewModel;

abstract class AbstractModule extends InjectTemplateListener implements ConfigProviderInterface
{
    protected $_moduleName;

    public function __construct()
    {
        $array = explode('\\', get_class($this));
        $this->_moduleName = $array[count($array) - 2];
    }


    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return array(
            'view_manager' => array(
                'template_path_stack' => array(
                    T_PATH_APPLICATION . '/view/' . strtolower($this->_moduleName) . '/',
                )
            )
        );
    }
}