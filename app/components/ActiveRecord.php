<?php

class ActiveRecord extends CActiveRecord
{
    public static function toArray($models)
    {
        // IF ITS ONE MODEL, IT MAY BE NULL
        if (is_null($models)) {
            return null;
        }

        if (is_array($models)) {
            $arrayMode = true;
        } else {
            $models = [$models];
            $arrayMode = false;
        }

        $result = [];
        foreach ($models as $model) {
            $attributes = $model->attributes;
            $relations = [];
            foreach ($model->relations() as $key => $related) {
                if ($model->hasRelated($key)) {
                    $relations[$key] = self::toArray($model->$key);
                }
            }
            $all = array_merge($attributes, $relations);

            if ($arrayMode) {
                array_push($result, $all);
            } else {
                $result = $all;
            }
        }
        return $result;
    }
}