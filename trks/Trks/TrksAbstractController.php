<?php

namespace Trks;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\Redirect;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

abstract class TrksAbstractController extends AbstractActionController
{
    abstract protected function createViewData(ViewModel $viewData);

    /**
     * @param $module
     * @param $controller
     * @param $action
     * @throws TrksForwardException
     */
    abstract protected function isAllowed($module, $controller, $action);

    public function onDispatch(MvcEvent $e)
    {
        $result = null;

        $routeMatch = $e->getRouteMatch();
        if (!$routeMatch) {
            throw new \Exception('no route matched!');
        }
        $module = $routeMatch->getParam('module', 'not-found');
        $controller = explode('-', $routeMatch->getParam('controller', 'notFound'));
        $controller = end($controller);
        $action = $routeMatch->getParam('action', 'not-found');
        if (!method_exists($this, static::getMethodFromAction($action))) {
            $action = 'not-found';
        }

        try {
            $this->isAllowed($module, $controller, $action);
            $result = parent::onDispatch($e);
        } catch (TrksForwardException $exception) {
            return $this->redirect()->toRoute($exception->redirectRoute, $exception->redirectParams, $exception->redirectOptions);
        }

        if ($result instanceof ViewModel) {
            $this->createViewData($result);
        }
        return $result;
    }
} 