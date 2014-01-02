<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 02.01.14
 * Time: 09:57
 */

namespace Trks\View\Helper;


use Zend\Form\ElementInterface;

class FormRadio extends FormMultiCheckbox
{
    /**
     * Return input type
     *
     * @return string
     */
    protected function getInputType()
    {
        return 'radio';
    }

    /**
     * Get element name
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected static function getName(ElementInterface $element)
    {
        return $element->getName();
    }
} 