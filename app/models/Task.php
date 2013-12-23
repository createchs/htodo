<?php

class Task extends BaseTask
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return [
            'ModelHistoryBehavior' => [
                'class' => 'application.behaviors.ModelHistoryBehavior'
            ],
        ];
    }
}