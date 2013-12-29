<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 29.12.13
 * Time: 03:34
 */

namespace StarboundLog\Tests;


use StarboundLog\Model\Entities\Users;
use StarboundLog\Model\Repositories\UsersRepository;

class Test extends \PHPUnit_Framework_TestCase
{
    public function testRegisterNew()
    {
        return;
        $x = Users::getRepo()->register("test", "test", "test@example.com");
        $this->assertInternalType('int', $x);
    }

    public function testAuth()
    {
        $this->assertNotNull(Users::getRepo()->auth("test", "test"));
        $this->assertNull(Users::getRepo()->auth("test", "test2"));
        $this->assertNull(Users::getRepo()->auth("test2", "test"));
        $this->assertEquals("test", Users::getRepo()->auth("test", "test")->getUserLogin());
    }

}
 