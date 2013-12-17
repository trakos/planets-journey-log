<?php

class StarboundLog
{
    static public $structureConfig = array(
        'Main' => array(
            'Index'
        )
    );

    static public $defaultModule = 'Main';

    static public function getModuleNamespaces()
    {
        return array_keys(self::getModulePaths());
    }

    static public function getModulePaths()
    {
        $array = array();
        foreach (self::$structureConfig as $moduleName => $controllers) {
            $array[MODULES_NAMESPACE . '\\' . $moduleName] = MODULES_PATH . $moduleName;
        }
        return $array;
    }

    static public function getControllersFor($moduleName)
    {
        $array = array();
        foreach (self::$structureConfig[$moduleName] as $controllerName) {
            $array[MODULES_NAMESPACE . '\\' . $moduleName . '\\' . $controllerName] = MODULES_NAMESPACE . '\\' . $moduleName . '\\' . $controllerName;
        }
        return $array;
    }
}