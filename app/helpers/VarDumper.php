<?php

class VarDumper extends CVarDumper
{
    public static function dump($var, $depth = 10, $highlight = true)
    {
        parent::dump($var, $depth, $highlight);
    }
}