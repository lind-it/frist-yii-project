<?php

use yii\db\Migration;


class m230825_154514_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('person', [
            'person_id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'fathername' => $this->string(),
            'edit_date' => $this->date(),
        ]);    

        $this->insert('person',[
            'name'=>'Арсений',
            'surname' => 'Кочетков',
            'fathername'=>'Денисович',
            'edit_date' => '2023-05-23',
        ]);

        $this->insert('person',[
            'name'=>'Артем',
            'surname' => 'Крючков',
            'fathername'=>'Дмитриевич',
            'edit_date' => '2022-07-10',
        ]);

        $this->insert('person',[
            'name'=>'Алина',
            'surname' => 'Кожевникова',
            'fathername'=>'Валерьевна',
            'edit_date' => '2023-01-15',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('person');
    }
}
