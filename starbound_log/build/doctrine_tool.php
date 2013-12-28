#!/usr/bin/env php

<?php

require(__DIR__ . '/../init.php');

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MyConvertMappingCommand extends \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('orm:my-convert-mapping')
            ->addOption('repository-namespace', null, InputOption::VALUE_REQUIRED, 'Repository namespace.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        define('REPOSITORY_NAMESPACE', $input->getOption('repository-namespace'));
        parent::execute($input, $output);
    }

    protected function getExporter($toType, $destPath)
    {
        $cme = new MyClassMetadataExporter();

        return $cme->getExporter($toType, $destPath);
    }
}

class MyClassMetadataExporter extends \Doctrine\ORM\Tools\Export\ClassMetadataExporter
{
    public function getExporter($type, $dest = null)
    {
        if ($type == 'annotation') return new MyAnnotationExporter($dest);
        return parent::getExporter($type, $dest);
    }
}

class MyAnnotationExporter extends \Doctrine\ORM\Tools\Export\Driver\AnnotationExporter
{
    public function setMetadata(array $metadata)
    {
        foreach ($metadata as $class) {
            /* @var \Doctrine\ORM\Mapping\ClassMetadataInfo $class */
            $nameExploded = explode('\\', $class->getName());
            $class->setCustomRepositoryClass(REPOSITORY_NAMESPACE . end($nameExploded) . 'Repository');
        }
        $this->_metadata = $metadata;
    }
}

\Doctrine\ORM\Tools\Console\ConsoleRunner::run(new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper(StarboundLog::getEntityManager()->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper(StarboundLog::getEntityManager())
)), array(
    new \StarboundLog\Library\Build\TrkConvertMappingCommand(),
    new \StarboundLog\Library\Build\TrkGenerateRepositoriesCommand(),
));