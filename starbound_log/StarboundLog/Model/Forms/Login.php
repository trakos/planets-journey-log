<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 02.01.14
 * Time: 03:41
 */

namespace StarboundLog\Model\Forms;

use Zend\Form\Annotation;

/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("Login")
 * @Annotation\Attributes({"class":" mws-form "})
 */
class Login
{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"username"})
     * @Annotation\Attributes({"placeholder":"username","class":"mws-login-username required"})
     */
    public $username;

    /**
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"password"})
     * @Annotation\Attributes({"placeholder":"password","class":"mws-login-password required"})
     */
    public $password;

    /*
     * @Annotation\Type("\Zend\Form\Element\Csrf")
     */
    public $csrf;

    /**
     * @Annotation\Type("\Trks\Form\Element\ButtonRow")
     * @Annotation\Attributes(
     * {
     *      "buttons": {
     *          {"value":"Login","class":"btn btn-success mws-login-button","style":"width:48%","isSubmit":1},
     *          {"value":"Cancel","class":"btn btn-danger mws-login-button","style":"width:48%","onClick":"history.go(-1); return false;"}
     *      },
     *      "class":"mws-form-row"
     * })
     */
    public $submit;
}