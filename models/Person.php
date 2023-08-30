<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Phone;

class Person extends ActiveRecord
{
    public function fields()
    {
        return [
            'person_id',
            'name' => function () 
            {
                return $this->name . ' ' . $this->surname . ' ' . $this->fathername;
            },
            'numbers'
        ];
    }

    public function getNumbers()
    {
        return $this->hasMany(Phone::class, ['person_id' => 'person_id']);
    }
     
    public function addPerson(string $name, string $surname, string $fathername, string $number)
    {;
        $this->name = $name;
        $this->surname = $surname;
        $this->fathername = $fathername;
        $this->edit_date = date("Y:m:d");
        $this->save();

        $query_data = self::find()->where([
            'name' => $name,
            'surname' => $surname,
            'fathername' => $fathername,
        s])->asArray()->one();

        if ($query_data == null)
        {
            echo "Пользователь не добавлен";
            return;
        }

        $phone = new Phone();
        $phone->AddData($number, $query_data['person_id']);

        if ($phone->error == "Номер не добавлен" || $phone->error == "Номер занят")
        {
            echo $phone->error;
            return;
        }
    }

    public function UpdatePerson(int $id, string $number)
    {
        $query_data = self::find()->where([
            'person_id' => $id,
          ])->one();

        if ($query_data == null)
        {
            echo "Пользователь не найден";
            return;
        }

        $phone = new Phone();
        $phone->AddData($number, $query_data['person_id']);

        if ($phone->error == "Номер не добавлен" || $phone->error == "Номер занят")
        {
            echo $phone->error;
            return;
        }

        $query_data->edit_date = date("Y:m:d");
        $query_data->save();
    }

    public function DeletePerson(int $id)
    {
        // попытка сделть присвоение $this->name, $this->surname, $this->fathername, через конструкстор ломает этото код
        // все остальные функции работают при присвоении через конструктор
        $removing_person = self::find()->where([
            'person_id' => $id,
          ])->one();

          if ($removing_person == null)
          {
              echo "Пользователь не найден";
              return;
          }

        $phone = new Phone();
        $phone->DeleteAllNumbers($removing_person['person_id']);
        
        $removing_person->delete();

    }

    public function rules()
    {
       return 
       [
            [['name', 'surname', 'fathername'], 'required']
       ];
    }
}
    
    

