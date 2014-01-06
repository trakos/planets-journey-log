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
 * Class CharacterEdit
 *
 * @package StarboundLog\Model\Forms
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Attributes({"class":"mws-form-inline mws-form "})
 */
class CharacterEditForm extends CharacterAddForm
{
    /**
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    public $id;
} 