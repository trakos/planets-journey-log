<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 29.12.13
 * Time: 01:45
 */

namespace StarboundLog\Model;


use StarboundLog\Library\MyAuth;
use Trks\Struct\MessagesStruct;

class ViewData
{
    /** @var \StarboundLog\Model\Database\Rows\Row_users */
    static public $identity;
    /**
     * @var \Trks\Struct\MessagesStruct
     */
    static private $messages;

    static public function getMessages()
    {
        return self::$messages ? : self::$messages = new MessagesStruct();
    }

} 