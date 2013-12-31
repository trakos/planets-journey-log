<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 31.12.13
 * Time: 03:04
 */

namespace StarboundLog\Model\Database\Entities;


use StarboundLog\Library\MyAcl;
use StarboundLog\Model\Database\Rows\Row_users;

class Entity_users extends Row_users
{
    public function getRole()
    {
        return MyAcl::ROLE_USER;
    }

    public function isAllowed($resourceName)
    {
        return MyAcl::getAcl()->isAllowed($this->getRole(), $resourceName);
    }
} 