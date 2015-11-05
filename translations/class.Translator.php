<?php
class Translator {

    //basic language is english
    private $language	= 'en';
    private $lang 		= array();

    public function __construct($language){
        $this->language = $language;
    }

    //look for identical string
    private function findString($str) {
        if (array_key_exists($str, $this->lang[$this->language])) {
            echo $this->lang[$this->language][$str];
            return null;
        }
        //if no string in textfiles use the given string
        echo $str;
    }

    //cut language row
    private function splitStrings($str) {
        return explode('=',trim($str));
    }

    //translate method based on english
    //uses addressbar to translate pages
    //e.g. by adding ?lang=fr at the end, the page will be translated in french
    public function __($str) {
        if (!array_key_exists($this->language, $this->lang)) {
            if (file_exists('translations/'.$this->language.'.txt')) {
                $strings = array_map(array($this,'splitStrings'),file('translations/'.$this->language.'.txt'));
                foreach ($strings as $k => $v) {
                    $this->lang[$this->language][$v[0]] = $v[1];
                }
                return $this->findString($str);
            }
            else {
                echo $str;
            }
        }
        else {
            return $this->findString($str);
        }
        return false;
    }
}