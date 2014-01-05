<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 03.01.14
 * Time: 12:45
 */

namespace Trks\Filter;


use Zend\I18n\Filter\Alnum;

class AlnumLocaleIndependent extends Alnum
{
    /**
     * Defined by Zend\Filter\FilterInterface
     *
     * Returns $value as string with all non-alphanumeric characters removed
     *
     * @param  mixed $value
     * @return string
     */
    public function filter($value)
    {
        $whiteSpace = $this->options['allow_white_space'] ? '\s' : '';

        $pattern = '/[^a-zA-Z0-9' . $whiteSpace . ']/';

        return preg_replace($pattern, '', (string) $value);
    }
} 