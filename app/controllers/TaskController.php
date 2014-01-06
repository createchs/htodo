<?php

class TaskController extends ApiController
{
    public function actionAll()
    {
        try {
            $models = Task::model()->ordered()->findAll();
            echo JSON::encodeModels($models);
        } catch (Exception $e) {
            throw new CHttpException(400, $e->getMessage());
        }
    }

    public function actionAllLog($logId)
    {
        try {
            $models = Task::model()->ordered($logId)->findAll();
            echo JSON::encodeModels($models);
        } catch (Exception $e) {
            throw new CHttpException(400, $e->getMessage());
        }
    }

    public function actionCreate()
    {
        try {
            $model = new Task;
            $model->title = $this->request['title'];
            $model->save();
            echo JSON::encodeModels($model);
        } catch (Exception $e) {
            throw new CHttpException(400, $e->getMessage());
        }
    }

    public function actionSaveOrder()
    {
        if (empty($this->request['order']) or !is_array($this->request['order'])) {
            throw new CHttpException(400, 'invalid order');
        }

        foreach ($this->request['order'] as $id) {
            if (!is_numeric($id)) {
                throw new CHttpException(400, 'invalid order');
            }
        }

        try {
            $model = ListOrder::model()->find();
            if ($model === null) {
                $model = new ListOrder;
            }
            $model->order = implode(',', $this->request['order']);
            $model->save();
            echo JSON::encodeModels($model);
        } catch (Exception $e) {
            throw new CHttpException(400, $e->getMessage());
        }
    }

    public function actionOrderLog()
    {
        try {
            $order = ListOrder::model()->find();
            if ($order) {
                $history = $order->getAttributeLog('order');
            } else {
                $history = [];
            }
            echo JSON::encodeModels($history);
        } catch (Exception $e) {
            throw new CHttpException(400, $e->getMessage());
        }
    }
}