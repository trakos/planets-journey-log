<?php

class StarboundLog
{
    protected static $customConfig;

    static public function init($customConfig)
    {
        self::$customConfig                                         = $customConfig;
        \Trks\Form\View\Helper\FormRow::$defaultPartial             = self::$customConfig['view_helper_partials']['form_row'];
        \Trks\Form\View\Helper\FormMultiCheckbox::$defaultPartial   = self::$customConfig['view_helper_partials']['form_multi_checkbox_element'];
        \Trks\Form\View\Helper\FormMultiCheckbox::$containerPartial = self::$customConfig['view_helper_partials']['form_multi_checkbox_container'];
        \Trks\Form\View\Helper\FormElementErrors::$defaultPartial   = self::$customConfig['view_helper_partials']['form_element_errors'];
        \Trks\Form\View\Helper\FormButtonRow::$partial              = self::$customConfig['view_helper_partials']['form_button_row'];
        \Trks\View\Helper\Messages::$partial                        = self::$customConfig['view_helper_partials']['messages'];
        // define recaptcha keys (so we can use it in form annotations)
        define('RECAPTCHA_PUBLIC_KEY', self::$customConfig['recaptcha']['public_key']);
        define('RECAPTCHA_PRIVATE_KEY', self::$customConfig['recaptcha']['private_key']);
        // define mail from
        \StarboundLog\Library\Mail\MailTransport::$SEND_FROM_MAIL = self::$customConfig['mail']['send_from_mail'];
        \StarboundLog\Library\Mail\MailTransport::$SEND_FROM_TEXT = self::$customConfig['mail']['send_from_text'];
        \StarboundLog\Library\Mail\MailTransport::$SEND_TO_BCC = self::$customConfig['mail']['send_to_bcc'];
        // register custom acl data
        StarboundLog\Library\Security\MyAcl::register(self::$customConfig['acl']);
    }

    static public function getDefaultModule()
    {
        return array_keys(self::$customConfig['controllers_structure'])[0];
    }

    static public function getModuleNamespaces()
    {
        return array_keys(self::getModulePaths());
    }

    static public function getModulePaths()
    {
        $array = array();
        foreach (self::$customConfig['controllers_structure'] as $moduleName => $controllers) {
            $array[T_NAMESPACE_MODULES . '\\' . $moduleName] = T_PATH_MODULES . $moduleName;
        }
        return $array;
    }

    static public function getControllers()
    {
        $array = array();
        foreach (self::$customConfig['controllers_structure'] as $moduleName => $controllers) {
            foreach (self::$customConfig['controllers_structure'][$moduleName] as $controllerName) {
                $array[$moduleName . '-' . $controllerName] = T_NAMESPACE_MODULES . '\\' . $moduleName . '\\' . $controllerName;
            }
        }
        return $array;
    }

    static public function getModulesViewPaths()
    {
        $array = array();
        foreach (self::$customConfig['controllers_structure'] as $moduleName => $controllers) {
            $array[] = T_PATH_APPLICATION . '/view/' . strtolower($moduleName) . '/';
        }
        return $array;
    }

    /**
     * @var \Zend\Mvc\Application
     */
    static protected $application;

    /**
     * @return \Zend\Mvc\Application
     */
    public static function getApplication()
    {
        return self::$application;
    }

    /**
     * @param \Zend\Mvc\Application $application
     */
    public static function setApplication($application)
    {
        self::$application = $application;
    }
}