<?php

class StarboundLog
{
    static protected $structureConfig = array(
        'Main' => array(
            'Index'
        )
    );

    static protected $defaultModule = 'Main';

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

    static protected $entityManager;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    static public function getEntityManager()
    {
        return self::$entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $value
     */
    static public function setEntityManager(\Doctrine\ORM\EntityManager $value)
    {
        self::$entityManager = $value;
    }
}