<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 30.12.13
 * Time: 07:09
 */

namespace Trks\Build\Sql;

use Doctrine\ORM\Mapping\ClassMetadataInfo,
    Doctrine\Common\Util\Inflector,
    Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\EntityGenerator;
use Zend\Db\TableGateway\TableGateway;

class TrksTableGenerator extends EntityGenerator
{
    /**
     * @var bool
     */
    private $backupExisting = true;

    /**
     * The extension to use for written php files
     *
     * @var string
     */
    private $extension = '.php';

    /**
     * Whether or not the current ClassMetadataInfo instance is new or old
     *
     * @var boolean
     */
    private $isNew = true;

    /**
     * @var array
     */
    private $staticReflection = array();

    /**
     * Number of spaces to use for indention in generated code
     */
    private $numSpaces = 4;

    /**
     * The actual spaces to use for indention
     *
     * @var string
     */
    private $spaces = '    ';

    /**
     * The class all generated entities should extend
     *
     * @var string
     */
    private $classToExtend;

    /**
     * Whether or not to re-generate entity class if it exists already
     *
     * @var boolean
     */
    private $regenerateEntityIfExists = false;

    public $rowNamespace;
    public $namespace;

    /**
     * @var array Hash-map to handle generator types string.
     */
    protected static $generatorStrategyMap = array(
        ClassMetadataInfo::GENERATOR_TYPE_AUTO      => 'AUTO',
        ClassMetadataInfo::GENERATOR_TYPE_SEQUENCE  => 'SEQUENCE',
        ClassMetadataInfo::GENERATOR_TYPE_TABLE     => 'TABLE',
        ClassMetadataInfo::GENERATOR_TYPE_IDENTITY  => 'IDENTITY',
        ClassMetadataInfo::GENERATOR_TYPE_NONE      => 'NONE',
        ClassMetadataInfo::GENERATOR_TYPE_UUID      => 'UUID',
        ClassMetadataInfo::GENERATOR_TYPE_CUSTOM    => 'CUSTOM'
    );

    protected static $arrayExchangeFieldTemplate = '$this-><property> = (isset($data[\'<property>\'])) ? $data[\'<property>\'] : null;';

    /**
     * @var string
     */
    private static $classTemplate =
'<?php

<namespace>

<entityAnnotation>
<entityClassName>
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new <table_class>());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get(\'Zend\Db\\Adapter\\Adapter\');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($this->getPrototype());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway(\'<row_table>\', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return <row_class>[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, $this->getPrototype());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return <row_class>
     */
    public function fetchRow($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, $this->getPrototype());
    }

    /**
     *
     * @return <row_class>[]
     */
    public function getAllRows()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     *
     * @param $id
     *
     * @throws \Exception
     * @return <row_class>
     */
    public function getRow($id)
    {
        $id  = (int) $id;
        $rowSet = $this->tableGateway->select(array(\'<row_primary_column>\' => $id));
        $row = $rowSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * @param <row_class> $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(<row_class> $row)
    {
        $data = array(
<array_assigns>
        );

        $id = (int)$row-><row_primary_column>;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row-><row_primary_column> = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array(\'<row_primary_column>\' => $id));
                return $id;
            } else {
                throw new \Exception(\'Row id does not exist\');
            }
        }
    }

    /**
     * @param int $id
     */
    public function deleteRow($id)
    {
        $this->tableGateway->delete(array(\'<row_primary_column>\' => $id));
    }

    /**
     *
     * @return <row_class>
     */
    protected function getPrototype()
    {
        return new <row_class>();
    }
}
';
    private static $arrayAssignTemplate = '\'<column>\' => $row-><column>,';

    public function __construct()
    {
        $this->regenerateEntityIfExists = true;
    }

    /**
     * Set the number of spaces the exported class should have
     *
     * @param integer $numSpaces
     * @return void
     */
    public function setNumSpaces($numSpaces)
    {
        $this->spaces = str_repeat(' ', $numSpaces);
        $this->numSpaces = $numSpaces;
    }

    /**
     * Set the name of the class the generated classes should extend from
     *
     * @param $classToExtend
     *
     * @return void
     */
    public function setClassToExtend($classToExtend)
    {
        $this->classToExtend = $classToExtend;
    }

    /**
     * Generate and write entity classes for the given array of ClassMetadataInfo instances
     *
     * @param array $metadatas
     * @param string $outputDirectory
     * @return void
     */
    public function generate(array $metadatas, $outputDirectory)
    {
        foreach ($metadatas as $metadata) {
            $this->writeEntityClass($metadata, $outputDirectory);
        }
    }

    /**
     * Generated and write entity class to disk for the given ClassMetadataInfo instance
     *
     * @param ClassMetadataInfo $metadata
     * @param string            $outputDirectory
     *
     * @throws \RuntimeException
     * @return void
     */
    public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        $path = $outputDirectory . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $metadata->name) . $this->extension;
        $dir = dirname($path);

        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $this->isNew = !file_exists($path) || (file_exists($path) && $this->regenerateEntityIfExists);

        $this->staticReflection[$metadata->name] = array('properties' => array(), 'methods' => array());

        if ($this->backupExisting && file_exists($path)) {
            $backupPath = dirname($path) . DIRECTORY_SEPARATOR . basename($path) . "~";
            if (!copy($path, $backupPath)) {
                throw new \RuntimeException("Attempt to backup overwritten entity file but copy operation failed.");
            }
        }

        // If entity doesn't exist or we're re-generating the entities entirely
        //if ($this->isNew) {
            file_put_contents($path, $this->generateEntityClass($metadata));
            // If entity exists and we're allowed to update the entity class
        /*} else if ( ! $this->isNew && $this->updateEntityIfExists) {
            file_put_contents($path, $this->generateUpdatedEntityClass($metadata, $path));
        }*/
    }

    /**
     * Generate a PHP5 Doctrine 2 entity class from the given ClassMetadataInfo instance
     *
     * @param ClassMetadataInfo $metadata
     * @return string $code
     */
    public function generateEntityClass(ClassMetadataInfo $metadata)
    {
        $placeHolders = array(
            '<namespace>',
            '<entityAnnotation>',
            '<entityClassName>',
            '<table_class>',
            '<row_class>',
            '<row_table>',
            '<row_primary_column>',
            '<array_assigns>'
        );

        $replacements = array(
            $this->generateEntityNamespace($metadata),
            $this->generateEntityDocBlock($metadata),
            $this->generateEntityTableClassName($metadata),
            $this->getEntityTableClassName($metadata),
            $this->getEntityRowClassName($metadata),
            $metadata->getTableName(),
            $this->getPrimaryIdColumn($metadata),
            $this->generateArrayAssigns($metadata)
        );

        $code = str_replace($placeHolders, $replacements, self::$classTemplate);
        return str_replace('<spaces>', $this->spaces, $code);
    }



    protected function generateEntityNamespace(ClassMetadataInfo $metadata)
    {
        return 'namespace ' . $this->namespace .';';
    }

    protected function generateEntityDocBlock(ClassMetadataInfo $metadata)
    {
        $lines = array(
            '/**',
            ' * ' . 'Table_' . $metadata->table['name'],
            ' * ',
            ' */'
        );

        return implode("\n", $lines);
    }

    protected function getEntityTableClassName(ClassMetadataInfo $metadata)
    {
        return 'Table_' . $metadata->table['name'];
    }

    protected function getEntityRowClassName(ClassMetadataInfo $metadata)
    {
        return '\\' . $this->rowNamespace . '\\' . 'Row_' . $metadata->table['name'];
    }

    protected function generateEntityTableClassName(ClassMetadataInfo $metadata)
    {
        return 'class ' . 'Table_' . $metadata->table['name'] .
        ($this->extendsClass() ? ' extends ' . $this->getClassToExtendName() : null);
    }

    protected function generateArrayAssigns(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->fieldMappings as $fieldMapping) {
            if (isset($fieldMapping['id']) && $fieldMapping['id']) {
                continue;
            }
            $lines[] = $this->spaces . $this->spaces . $this->spaces . str_replace('<column>', $fieldMapping['columnName'], self::$arrayAssignTemplate);
        }

        return implode("\n", $lines);
    }

    protected function getPrimaryIdColumn(ClassMetadataInfo $metadata)
    {
        foreach ($metadata->fieldMappings as $fieldMapping) {
            if (isset($fieldMapping['id']) && $fieldMapping['id']) {
                return $fieldMapping['columnName'];
            }
        }
        throw new \Exception('No PK found in ' . $metadata->getTableName() . '!');
    }

    private function extendsClass()
    {
        return $this->classToExtend ? true : false;
    }

    private function getClassToExtend()
    {
        return $this->classToExtend;
    }

    private function getClassToExtendName()
    {
        $refl = new \ReflectionClass($this->getClassToExtend());

        return '\\' . $refl->getName();
    }

    private function hasProperty($property, ClassMetadataInfo $metadata)
    {
        if ($this->extendsClass()) {
            // don't generate property if its already on the base class.
            $reflClass = new \ReflectionClass($this->getClassToExtend());
            if ($reflClass->hasProperty($property)) {
                return true;
            }
        }

        return (
            isset($this->staticReflection[$metadata->name]) &&
            in_array($property, $this->staticReflection[$metadata->name]['properties'])
        );
    }
}
