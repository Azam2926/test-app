<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%take_answer}}`.
 */
class m210718_091604_create_take_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%take_answer}}', [
            'id' => $this->primaryKey(),
            'take_id' => $this->integer(),
            'question_id' => $this->integer(),
            'answer_id' => $this->integer(),
            'content' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-take_id-take_answer', 'take_answer', 'take_id', 'take', 'id');
        $this->addForeignKey('fk-question_id-take_answer', 'take_answer', 'question_id', 'question', 'id');
        $this->addForeignKey('fk-answer_id-take_answer', 'take_answer', 'answer_id', 'question_answer', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%take_answer}}');
    }
}
