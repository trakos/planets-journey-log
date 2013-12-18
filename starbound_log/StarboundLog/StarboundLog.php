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
            $array[T_NAMESPACE_MODULES . '\\' . $moduleName] = T_PATH_MODULES . $moduleName;
        }
        return $array;
    }

    static public function getControllersFor($moduleName)
    {
        $array = array();
        foreach (self::$structureConfig[$moduleName] as $controllerName) {
            $array[T_NAMESPACE_MODULES . '\\' . $moduleName . '\\' . $controllerName] = T_NAMESPACE_MODULES . '\\' . $moduleName . '\\' . $controllerName;
        }
        return $array;
    }
}