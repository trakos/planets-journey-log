<?php

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