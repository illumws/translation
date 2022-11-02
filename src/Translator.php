<?php

namespace Illuminate\Validation\Translation;

use Illuminate\Support\Arr;

class Translator implements \Illuminate\Contracts\Translation\Translator {

    /**
     * @var array
     */
    protected array $translations = [];

    public function __construct($folder, $lang = 'en')
    {

        $path = $folder.DIRECTORY_SEPARATOR.$lang;

        $list = preg_grep('~\.(php)$~', scandir($path));
        foreach ($list as $file){
            $array = require $path.DIRECTORY_SEPARATOR.$file;
            if(is_array($array)) {
                $this->translations[basename($file, '.php')] = $array;
            }
        }
    }

    /**
     * @param $key
     * @param array $replace
     * @param $locale
     * @return array|\ArrayAccess|mixed
     */
    public function get($key, array $replace = [], $locale = null)
    {
        return Arr::get($this->translations, $key, $key);
    }

    public function choice($key, $number, array $replace = [], $locale = null)
    {
        // TODO: Implement choice() method.
    }

    public function getLocale()
    {
        // TODO: Implement getLocale() method.
    }

    public function setLocale($locale)
    {
        // TODO: Implement setLocale() method.
    }
}