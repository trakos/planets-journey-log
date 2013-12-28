<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace StarboundLog\Library\Build;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Class to generate entity repository classes
 *
 * 
 * @link    www.doctrine-project.org
 * @since   2.0
 * @author  Benjamin Eberlei <kontakt@beberlei.de>
 * @author  Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author  Jonathan Wage <jonwage@gmail.com>
 * @author  Roman Borschel <roman@code-factory.org>
 */
class TrkEntityRepositoryGenerator
{
    protected static $_template =
'<?php

namespace <namespace>;

use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\LockMode;

/**
 * <className>
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class <className> extends EntityRepository
{
    /**
     * @inheritdoc
     *
     * @return <entity>[]
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @inheritdoc
     * @param array $criteria
     * @param array $orderBy
     * @param null  $limit
     * @param null  $offset
     *
     * @return <entity>[]
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     * @param mixed $id
     * @param int   $lockMode
     * @param null  $lockVersion
     *
     * @return <entity>
     */
    public function find($id, $lockMode = LockMode::NONE, $lockVersion = null)
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    /**
     * @inheritdoc
     * @param array $criteria
     * @param array $orderBy
     *
     * @return <entity>
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }
}
';

    public function generateEntityRepositoryClass($fullClassName, $entityName)
    {
        $namespace = substr($fullClassName, 0, strrpos($fullClassName, '\\'));
        $className = substr($fullClassName, strrpos($fullClassName, '\\') + 1, strlen($fullClassName));

        $variables = array(
            '<namespace>' => $namespace,
            '<className>' => $className,
            '<entity>' => $entityName
        );
        return str_replace(array_keys($variables), array_values($variables), self::$_template);
    }

    public function writeEntityRepositoryClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        //$nameExploded = explode('\\', $metadata->getName());
        $entityName = '\\' . $metadata->getName();//end($nameExploded);

        $fullClassName = $metadata->customRepositoryClassName;
        $code = $this->generateEntityRepositoryClass($fullClassName, $entityName);

        $path = $outputDirectory . DIRECTORY_SEPARATOR
              . str_replace('\\', \DIRECTORY_SEPARATOR, $fullClassName) . '.php';
        $dir = dirname($path);

        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        if ( ! file_exists($path)) {
            file_put_contents($path, $code);
        }
    }
}