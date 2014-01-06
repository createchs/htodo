<?php

class Task extends BaseTask
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function ordered($logId = null)
    {
        $order = false;

        if (!$logId) {
            $ListOrder = ListOrder::model()->find();
            if ($ListOrder) {
                $order = $ListOrder->order;
            }
        } else {
            $log = ModelLog::model()->findByPk($logId);
            if ($log) {
                $order = $log->attrLog->value;
            }
        }

        if ($order) {
            $this->getDbCriteria()->mergeWith([
                'order' => 'FIELD(id, ' . $order . ')',
            ]);
            $this->getDbCriteria()->addInCondition('id', explode(',', $order));
        }

        return $this;
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {
            $ListOrder = ListOrder::model()->find();
            if ($ListOrder) {
                $order = explode(',', $ListOrder->order);
                $order[] = $this->id;
                $order = implode(',', $order);
                $ListOrder->order = $order;
                $ListOrder->save();
            } else {
                $ListOrder = new ListOrder();
                $ListOrder->order = $this->id;
                $ListOrder->save();
            }
        }
    }
}
