<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 03.01.14
 * Time: 12:25
 */

namespace Trks\Validator;


use Zend\Validator\Db\NoRecordExists;

class DbNoRecordExists extends NoRecordExists
{

    public function __construct($options = null)
    {
        if (isset($options['adapter']) && is_string($options['adapter'])) {
            $options['adapter'] = \StarboundLog::getApplication()->getServiceManager()->get($options['adapter']);
        }
        parent::__construct($options);
    }
} 