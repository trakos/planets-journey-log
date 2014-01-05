<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 05.01.14
 * Time: 10:59
 */

namespace StarboundLog\Library\Mail;


use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

class MailRenderer
{
    /**
     * @var PhpRenderer
     */
    static private $_instance;

    /**
     * @return PhpRenderer
     */
    public static function get()
    {
        if (!self::$_instance) {
            self::$_instance = new PhpRenderer();
            self::$_instance->setResolver(new \Zend\View\Resolver\TemplatePathStack(array(
                'script_paths' => array(T_PATH_MAIL_VIEW)
            )));
            /**
             * @var \Zend\View\Helper\Url $urlHelperPlugin
             */
            $urlHelperPlugin = self::$_instance->plugin('url');
            $urlHelperPlugin->setRouter(\StarboundLog::getApplication()->getServiceManager()->get(\Zend\Console\Console::isConsole() ? 'HttpRouter' : 'Router'));
            $urlHelperPlugin->setRouteMatch(\StarboundLog::getApplication()->getMvcEvent()->getRouteMatch());
        }
        return self::$_instance;
    }

    /**
     * @param $template
     * @param null|array|\ArrayAccess $variables
     *
     * @return string
     */
    public static function render($template, $variables)
    {
        return self::get()->render($template, $variables);
    }

} 