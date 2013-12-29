<?php

namespace Trks;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

abstract class TrksAbstractController extends AbstractActionController
{
    abstract protected function createViewData(ViewModel $viewData);

    public function onDispatch(MvcEvent $e)
    {
        $result = parent::onDispatch($e);
        if ($result instanceof ViewModel) {
            $this->createViewData($result);
        }
        return $result;
    }
} 