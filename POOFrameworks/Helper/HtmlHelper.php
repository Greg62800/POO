<?php

namespace POO\Helper;


class HtmlHelper extends Helper
{

    public function css($filename)
    {
        if(!is_array($filename)) {
            $url = BASE . '/css/' . $filename . '.css';
            $html = '<link rel="stylesheet" href="' . $url . '" />';
            return $html;
        }
    }

    public function cssUrl($url) {
        $html = '<link rel="stylesheet" href="' . $url . '" />';
        return $html;
    }
}