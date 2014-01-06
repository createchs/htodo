<?php

class ApiController extends Controller
{
    public $request;

    public function beforeAction($action)
    {
        $this->request = JSON::decode(file_get_contents('php://input'));
        return parent::beforeAction($action);
    }
}