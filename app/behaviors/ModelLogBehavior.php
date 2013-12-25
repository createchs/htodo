<?php

class ModelLogBehavior extends CActiveRecordBehavior
{
    const EVENT_INSERT = 'insert';
    const EVENT_UPDATE = 'update';
    const EVENT_DELETE = 'delete';

    private $_old_attributes = [];

    public function afterFind($event)
    {
        $this->oldAttributes = $this->owner->attributes;
    }

    // @TODO: if !currentTransaction - обернуть в транзакцию
    // @TODO: сделать хранение значения старого атрибута
    public function afterSave($event)
    {
        $changedAttributes = $this->getAttributesDiff($this->oldAttributes);

        // ведем лог только если чтото изменилось
        if (!$changedAttributes) {
            return;
        }

        $ModelLog = new ModelLog;
        $ModelLog->created_at = $this->dbNow;
        $ModelLog->model = $this->modelName;
        $ModelLog->pk = $this->modelPrimaryKey;
        $ModelLog->event = $this->modelEvent;
        $ModelLog->save();

        foreach ($changedAttributes as $attr_name => $attr_value) {
            $AttrLog = new AttrLog;
            $AttrLog->model_log_id = $ModelLog->primaryKey;
            $AttrLog->name = $attr_name;
            $AttrLog->value = $attr_value;
            $AttrLog->old_value = $this->getOldAttrValue($attr_name);
            $AttrLog->save();
        }

        // Для последующих сохранений модели
        $this->oldAttributes = $this->owner->attributes;
    }

    public function afterDelete($event)
    {
        $ModelLog = new ModelLog;
        $ModelLog->created_at = $this->dbNow;
        $ModelLog->model = $this->modelName;
        $ModelLog->pk = $this->modelPrimaryKey;
        $ModelLog->event = self::EVENT_DELETE;
        $ModelLog->save();
    }

    // для найденного объекта реализовать getAttrLog('attr_name') возвращающий список моделей изменений этого атрибута в хронологическом порядке
    // $Logs = Item::model()->findByPk(1)->getAttrLog('attr_name');
    // получаем массив моделей экземпляров модели AttrLog, в приджоиненными метаданными из ModelLog
    public function getAttributesLog($attr_name)
    {
        return;
    }





    public function getModelName()
    {
        return get_class($this->owner);
    }

    public function getModelPrimaryKey()
    {
        return $this->owner->primaryKey;
    }

    public function getModelEvent()
    {
        return $this->owner->isNewRecord ? self::EVENT_INSERT : self::EVENT_UPDATE;
    }

    public function getDbNow()
    {
        return new CDbExpression('NOW()');
    }

    public function getAttributesDiff($attrs)
    {
        return array_diff_assoc($this->owner->attributes, $attrs);
    }

    public function getOldAttributes()
    {
        return $this->_old_attributes;
    }

    public function setOldAttributes($attributes)
    {
        $this->_old_attributes = $attributes;
    }

    public function getOldAttrValue($attr_name)
    {
        return $this->oldAttributes[$attr_name];
    }
}