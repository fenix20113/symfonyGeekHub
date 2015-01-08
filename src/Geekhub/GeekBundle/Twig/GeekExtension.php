<?php

namespace Geekhub\GeekBundle\Twig;


class GeekExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
          new \Twig_SimpleFilter('summary', array($this, 'characterLimiter')),
        );
    }

    /**
     * Character Limiter
     *
     * Limits the string based on the character count.  Preserves complete words
     * so the character count may not be exactly as specified.
     *
     * @access   public
     * @param    string
     * @param    integer
     * @param    string  the end character. Usually an ellipsis
     * @return   string
     */

    public function characterLimiter($str, $n = 500, $end_char = '&#8230;')
    {
        if (strlen($str) < $n) {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace( array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n) {
            return $str;
        }

        $out = "";
        foreach (explode(' ', trim($str)) as $val) {
            $out .= $val . ' ';

            if (strlen($out) >= $n) {
                $out = trim($out);

                return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
        return false;
    }

    public function getName()
    {
        return 'geek_extension';
    }

}
