<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 03.01.14
 * Time: 09:00
 */

namespace Trks\Struct;


class MessagesStruct
{
    /**
     * @var string
     */
    public $errorMain;
    /**
     * @var string[]
     */
    public $errorList = [];

    /**
     * @var string
     */
    public $successMain;
    /**
     * @var string[]
     */
    public $successList = [];

    /**
     * @var string
     */
    public $warningMain;
    /**
     * @var string[]
     */
    public $warningList = [];

    /**
     * @var string
     */
    public $infoMain;
    /**
     * @var string[]
     */
    public $infoList = [];
} 