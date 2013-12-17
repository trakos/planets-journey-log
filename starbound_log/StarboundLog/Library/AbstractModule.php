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

abstract class AbstractModule extends InjectTemplateListener implements ConfigProviderInterface, BootstrapListenerInterface
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
            'controllers'  => array(
                'invokables' => \StarboundLog::getControllersFor($this->_moduleName)
            ),
            'view_manager' => array(
                'template_path_stack' => array(
                    APPLICATION_PATH . '/view/' . strtolower($this->_moduleName) . '/',
                )
            )
        );
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     *
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        if ($e instanceof MvcEvent) {
            $e
                ->getApplication()
                ->getEventManager()
                ->getSharedManager()
                ->attach('Zend\Stdlib\DispatchableInterface', MvcEvent::EVENT_DISPATCH, array($this, 'injectTemplate'), -91);
        }
        /* if ($e instanceof MvcEvent) {
             $eventManager        = $e->getApplication()->getEventManager();
             $moduleRouteListener = new ModuleRouteListener();
             $moduleRouteListener->attach($eventManager);
         }*/
    }

    public function injectTemplate(MvcEvent $e)
    {
        $model = $e->getResult();
        if (!$model instanceof ViewModel) {
            return;
        }

        $routeMatch = $e->getRouteMatch();
        $controller = $e->getTarget();
        if (is_object($controller)) {
            $controller = get_class($controller);
        }
        if (!$controller) {
            $controller = $routeMatch->getParam('controller', '');
        }

        $controller = $this->deriveControllerClass($controller);
        $module = $this->_moduleName;

        $template   = $this->inflectName($module);

        if (!empty($template)) {
            $template .= '/';
        }
        $template  .= $this->inflectName($controller);

        $action     = $routeMatch->getParam('action');
        if (null !== $action) {
            $template .= '/' . $this->inflectName($action);
        }
        $model->setTemplate($template);
    }
}