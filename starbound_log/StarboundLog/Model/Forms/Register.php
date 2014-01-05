<?php

namespace StarboundLog\Model\Forms;

use Zend\Form\Annotation;

/**
 * Class Register
 *
 * @package StarboundLog\Model\Forms
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Attributes({"class":"mws-form-inline mws-form "})
 */
class Register
{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"Username"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"6","max":"63"}})
     * @Annotation\Validator({"name":"\Trks\Validator\AlnumLocaleIndependent"})
     * @Annotation\Validator(
     *      {
     *          "name":"\Trks\Validator\DbNoRecordExists",
     *          "options":
     *          {
     *              "table":"users",
     *              "field":"user_login",
     *              "adapter":"Zend\Db\Adapter\Adapter",
     *              "messages":
     *              {
     *                  "recordFound":"This username is already taken"
     *              }
     *          }
     *      }
     * )
     */
    public $username;

    /**
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"6"}})
     * @Annotation\Options({"label":"Password"})
     */
    public $password;
    /**
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"Password (confirm)"})
     * @Annotation\Validator({"name":"Identical","options":{"token":"password","messageTemplates":{"notSame":"Passwords do not match"}}})
     */
    public $repeatPassword;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Options(
     *      {
     *          "label":"E-mail address",
     *      }
     * )
     * @Annotation\Validator({"name":"EmailAddress"})
     * @Annotation\Validator(
     *      {
     *          "name":"\Trks\Validator\DbNoRecordExists",
     *          "options":
     *          {
     *              "table":"users",
     *              "field":"user_mail",
     *              "adapter":"Zend\Db\Adapter\Adapter",
     *              "messages":
     *              {
     *                  "recordFound":"Account with this e-mail address already exists"
     *              }
     *          }
     *      }
     * )
     */
    public $mail;

    /**
     * @Annotation\Type("Zend\Form\Element\Captcha")
     * @Annotation\Options(
     *      {
     *          "captcha":
     *          {
     *              "class":"recaptcha",
     *              "options":
     *              {
     *                  "private_key":RECAPTCHA_PRIVATE_KEY,
     *                  "public_key":RECAPTCHA_PUBLIC_KEY,
     *                  "messages":
     *                  {
     *                      "missingValue":"Captcha value is missing",
     *                      "badCaptcha":"Captcha value is wrong"
     *                  }
     *              }
     *          }
     *      }
     *  )
     */
    public $captcha;

    /**
     * @Annotation\Type("\Zend\Form\Element\Csrf")
     * @Annotation\Required({"required":"true"})
     */
    public $csrf;

    /**
     * @Annotation\Type("\Trks\Form\Element\ButtonRow")
     * @Annotation\Attributes({"buttons":{"Submit":1}})
     */
    public $submit;

} 