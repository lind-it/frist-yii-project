<?php

namespace app\controllers;

use Yii;
use app\models\Person;
use yii\rest\ActiveController;

class PhoneController extends ActiveController
{
    public $modelClass = 'app\models\Person';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions["create"], $actions["update"], $actions["delete"]);
        return $actions;
    }


    public function actionCreate()
    {
        $data = \Yii::$app->request->post();
        $person = new Person();
        $person->addPerson($data["name"], $data["surname"], $data["fathername"], $data["number"]);
    }

    public function actionUpdate()
    {
        $data = \Yii::$app->request->post();
        $person = new Person();
        $person->UpdatePerson($data["id"], $data["number"]);
    }

    public function actionDelete()
    {
        $data = \Yii::$app->request->post();
        $person = new Person();
        $person->DeletePerson($data["id"]);
    }
    
}