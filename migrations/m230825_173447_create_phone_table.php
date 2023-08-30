<?php

use yii\db\Migration;


class m230825_173447_create_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('phone', [
            'phone_id' => $this->primaryKey(),
            'number' => $this->string()->unique(),
            'person_id' => $this->integer(),
        ]);

        $this->insert('phone',[
            'number'=>'+7 (999) 11-111-11',
            'person_id' => '1',
        ]);

        $this->insert('phone',[
            'number'=>'+7 (999) 99-999-99',
            'person_id' => '1',
        ]);

        $this->insert('phone',[
            'number'=>'+7 (999) 55-555-55',
            'person_id' => '1',
        ]);


        $this->insert('phone',[
            'number'=>'+7 (977) 777-77-77',
            'person_id' => '2',
        ]);

        $this->insert('phone',[
            'number'=>'+7 (988)555-55-55',
            'person_id' => '3',
        ]);

        $this->addForeignKey(
            'person_id',
            'phone',
            'person_id',
            'person',
            'person_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'person_id',
            'phone'
        );
        $this->dropTable('phone');
    }
}
