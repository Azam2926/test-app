<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question_answer}}`.
 */
class m210718_081106_create_question_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question_answer}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'question_id' => $this->integer(),
            'content' => $this->text(),
            'correct' => $this->tinyInteger()->notNull()->defaultValue(0),
            'active' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-test_id-question_answer', 'question_answer', 'test_id', 'test', 'id');
        $this->addForeignKey('fk-question_id-question_answer', 'question_answer', 'question_id', 'question', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question_answer}}');
    }
}
