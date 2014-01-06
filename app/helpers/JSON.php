<?php

class JSON extends CJSON
{
    public static function encodeModels($models)
    {
        return self::encode(ActiveRecord::toArray($models));
    }
}