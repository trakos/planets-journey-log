<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 05.01.14
 * Time: 10:23
 */

namespace StarboundLog\Library\Mail;


use Zend\Mail\Transport\Sendmail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class MailTransport
{
    static public $SEND_FROM_MAIL;
    static public $SEND_FROM_TEXT;
    static public $SEND_TO_BCC;


    static private $_instance;

    /**
     * @return \Zend\Mail\Transport\TransportInterface
     */
    static public function get()
    {
        return self::$_instance ? : (self::$_instance = new Sendmail());
    }

    static public function send($mailTo, $subject, $body)
    {
        $html = new MimePart($body);
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts(array($html));

        self::get()->send(
            (new \Zend\Mail\Message())
                ->setEncoding("UTF-8")
                ->addFrom(self::$SEND_FROM_MAIL, self::$SEND_FROM_TEXT)
                ->addBcc(self::$SEND_TO_BCC)
                ->addTo($mailTo)
                ->setSubject($subject)
                ->setBody($body)
        );
    }

} 