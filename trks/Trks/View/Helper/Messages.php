<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 03.01.14
 * Time: 09:07
 */

namespace Trks\View\Helper;


use Trks\Struct\MessagesStruct;
use Zend\I18n\View\Helper\AbstractTranslatorHelper;

class Messages extends AbstractTranslatorHelper
{
    static $partial = null;

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     */
    public function __invoke(MessagesStruct $messages = null)
    {
        if (!$messages) {
            return $this;
        }

        return $this->render($messages);
    }

    private function render(MessagesStruct $messages)
    {
        if (!self::$partial) {
            throw new \Exception("no partial given for Messages view helper!");
        }

        return $this->view->render(self::$partial, array(
            'messages' => $messages
        ));
    }
} 