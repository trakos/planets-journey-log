<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 29.12.13
 * Time: 03:34
 */

namespace StarboundLog\Tests;


use StarboundLog\Library\MyAcl;
use StarboundLog\Model\Database\Proxies\Proxy_users;
use StarboundLog\Model\Database\Tables\Table_users;

class Test extends \PHPUnit_Framework_TestCase
{
    /*public function testRegisterNew()
    {
        $login = "test_inny3";
        $password = "asdfggagag";
        $mail = "test_inny@example.com";
        $x = Proxy_users::get()->register($login, $password, $mail);
        $this->assertInternalType('int', $x->user_id);
        $this->assertInstanceOf('StarboundLog\Model\Database\Rows\Row_users', $x);
        $this->assertEquals($login, $x->user_login);
        $this->assertTrue(password_verify($password, $x->user_password));
        $this->assertEquals($mail, $x->user_mail);
    }*/

    public function testAuth()
    {
        $this->assertNotNull(Proxy_users::get()->auth("test", "test"));
        $this->assertNull(Proxy_users::get()->auth("test", "test2"));
        $this->assertNull(Proxy_users::get()->auth("test2", "test"));
        $this->assertEquals("test", Proxy_users::get()->auth("test", "test")->user_login);
    }

    public function testGenerator()
    {
        ob_start();

        $this->assertEquals('test', Table_users::get()->fetchRow('SELECT * FROM users WHERE user_login = ?', array('test'))->user_login);

        $this->assertEquals('', ob_get_clean() || '');
    }

    public function testAcl()
    {
        $this->assertFalse(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_ADMIN, MyAcl::RES_LOGGED_OFF));
        $this->assertFalse(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_USER, MyAcl::RES_LOGGED_OFF));
        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_GUEST, MyAcl::RES_LOGGED_OFF));

        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_ADMIN, MyAcl::RES_GUEST));
        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_USER, MyAcl::RES_GUEST));
        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_GUEST, MyAcl::RES_GUEST));

        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_ADMIN, MyAcl::RES_USER));
        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_USER, MyAcl::RES_USER));
        $this->assertFalse(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_GUEST, MyAcl::RES_USER));

        $this->assertTrue(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_ADMIN, MyAcl::RES_ADMIN));
        $this->assertFalse(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_USER, MyAcl::RES_ADMIN));
        $this->assertFalse(MyAcl::getAcl()->isAllowed(MyAcl::ROLE_GUEST, MyAcl::RES_ADMIN));

    }

}
 