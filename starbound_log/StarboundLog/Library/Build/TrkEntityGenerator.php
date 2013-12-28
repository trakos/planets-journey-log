<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 28.12.13
 * Time: 17:30
 */

namespace StarboundLog\Library\Build;


use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Tools\EntityGenerator;

class TrkEntityGenerator extends EntityGenerator
{
    /**
     * Generate a PHP5 Doctrine 2 entity class from the given ClassMetadataInfo instance
     *
     * @param ClassMetadataInfo $metadata
     * @return string $code
     */
    public function generateEntityClass(ClassMetadataInfo $metadata)
    {
        $code = parent::generateEntityClass($metadata);

        $className = $metadata->getName();
        $repositoryClassName = $metadata->customRepositoryClassName;
        $insertion = <<<X

    /**
     * @return \\$repositoryClassName
     */
    static public function getRepo()
    {
        return \\StarboundLog::getEntityManager()->getRepository('$className');
    }

X;
        $code = substr_replace($code, $insertion, strpos($code, '{') + 1, 0);
        return $code;
    }

    /**
     * Generate the updated code for the given ClassMetadataInfo and entity at path
     *
     * @param ClassMetadataInfo $metadata
     * @param string $path
     * @return string $code;
     */

    /**
     * @param ClassMetadataInfo $metadata
     * @param string            $path
     *
     * @return string
     */
    public function generateUpdatedEntityClass(ClassMetadataInfo $metadata, $path)
    {
        $code = parent::generateEntityClass($metadata, $path);
        echo $code;
        return $code;
    }
} 