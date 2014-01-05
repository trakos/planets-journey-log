<?php

class StarboundLog
{

    static public $structureConfig;
    static public $viewHelperPartialsConfig;
    public static $recaptchaConfig;
    public static $aclConfig;

    static public function init()
    {
        \Trks\Form\View\Helper\FormRow::$defaultPartial             = self::$viewHelperPartialsConfig['partials']['form_row'];
        \Trks\Form\View\Helper\FormMultiCheckbox::$defaultPartial   = self::$viewHelperPartialsConfig['partials']['form_multi_checkbox_element'];
        \Trks\Form\View\Helper\FormMultiCheckbox::$containerPartial = self::$viewHelperPartialsConfig['partials']['form_multi_checkbox_container'];
        \Trks\Form\View\Helper\FormElementErrors::$defaultPartial   = self::$viewHelperPartialsConfig['partials']['form_element_errors'];
        \Trks\Form\View\Helper\FormButtonRow::$partial              = self::$viewHelperPartialsConfig['partials']['form_button_row'];
        \Trks\View\Helper\Messages::$partial                        = self::$viewHelperPartialsConfig['partials']['messages'];
        define('RECAPTCHA_PUBLIC_KEY', self::$recaptchaConfig['recaptcha']['public_key']);
        define('RECAPTCHA_PRIVATE_KEY', self::$recaptchaConfig['recaptcha']['private_key']);
        // register custom acl data
        StarboundLog\Library\Security\MyAcl::register();
    }

    static public function getDefaultModule()
    {
        return array_keys(self::$structureConfig)[0];
    }

    static public function getModuleNamespaces()
    {
        return array_keys(self::getModulePaths());
    }

    static public function getModulePaths()
    {
        $array = array();
        foreach (self::$structureConfig as $moduleName => $controllers) {
            $array[T_NAMESPACE_MODULES . '\\' . $moduleName] = T_PATH_MODULES . $moduleName;
        }
        return $array;
    }

    static public function getControllers()
    {
        $array = array();
        foreach (self::$structureConfig as $moduleName => $controllers) {
            foreach (self::$structureConfig[$moduleName] as $controllerName) {
                $array[$moduleName . '-' . $controllerName] = T_NAMESPACE_MODULES . '\\' . $moduleName . '\\' . $controllerName;
            }
        }
        return $array;
    }

    static public function getModulesViewPaths()
    {
        $array = array();
        foreach (self::$structureConfig as $moduleName => $controllers) {
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