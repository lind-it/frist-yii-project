<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Phone extends ActiveRecord
{

    public $error;

    public function rules()
    {
       return [
                [['number', 'person_id'], 'required'],
                ['number', 'match', 'pattern'=>'/^\+7\s\([0-9]{3}\)\s[0-9]{2}\-[0-9]{3}\-[0-9]{2}$/']
              ];
    }

    public function AddData(string $number, string $person_id)
    {
        $this->person_id = $person_id;
        $this->number = $number;
        try
        {
            $this->save();
        }
        catch (yii\db\IntegrityException $e)
        {
            $this->error = "Номер занят";
        }

        $query_data = self::find()->where([
            'number' => $number,
            'person_id' => $person_id,
          ])->one();

        if ($query_data == null)
        {
            $this->error = "телефон не добавлен";
        }
    }


    public function DeleteNumber(string $number, string $person_id)
    {
        $removing_number = self::find()->where([
            'number' => $number,
            'person_id' => $person_id,
          ])->one();
          
        $removing_number->delete();
    }

    public function DeleteAllNumbers( string $person_id)
    {
        self::deleteAll(['person_id' => $person_id]);
    }
}