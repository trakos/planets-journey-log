<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 06.01.14
 * Time: 07:11
 */

namespace StarboundLog\Model\Forms;

use Zend\Form\Annotation;

/**
 * Class CharacterAdd
 *
 * @package StarboundLog\Model\Forms
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Attributes({"class":"mws-form-inline mws-form "})
 */
class CharacterAddForm
{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"Character name"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"3","max":"63"}})
     * @Annotation\Validator({"name":"\Trks\Validator\AlnumLocaleIndependent"})
     */
    public $name;

    /**
     * @Annotation\Type("\Zend\Form\Element\Csrf")
     * @Annotation\Required({"required":"true"})
     */
    public $csrf;

    /**
     * @Annotation\Type("\Trks\Form\Element\ButtonRow")
     * @Annotation\Attributes({"buttons":{"Submit":1,"Cancel":-1}})
     */
    public $submit;
} 