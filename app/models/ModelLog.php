<?php

class ModelLog extends BaseModelLog
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function relations()
    {
        return CMap::mergeArray(parent::relations(), [
            'attrLog' => array(self::HAS_ONE, 'AttrLog', 'model_log_id'),
        ]);
    }

    public function scopes()
    {
        return [
            'recently' => [
                'order' => 'created_at DESC',
            ],
        ];
    }

    public function byModel($model_name)
    {
        $this->getDbCriteria()->mergeWith([
            'condition' => 'model = :model',
            'params' => [
                ':model' => $model_name,
            ],
        ]);
        return $this;
    }

    public function byPk($pk)
    {
        $this->getDbCriteria()->mergeWith([
            'condition' => 'pk = :pk',
            'params' => [
                ':pk' => $pk,
            ],
        ]);
        return $this;
    }

    public function byAttrName($attr_name)
    {
        $this->getDbCriteria()->mergeWith([
            'with' => 'attrLog',
            'condition' => 'attrLog.name = :attr_name',
            'params' => [
                ':attr_name' => $attr_name,
            ],
        ]);
        return $this;
    }

    public function getAttributeLogValue()
    {
        return $this->attrLog->value;
    }
}
