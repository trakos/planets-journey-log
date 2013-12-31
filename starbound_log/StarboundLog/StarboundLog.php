<?php

class StarboundLog
{
    static protected $structureConfig = array(
        'Main' => array(
            'Home', 'Planets', 'User'
        ),
    );

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