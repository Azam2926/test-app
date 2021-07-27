<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m210718_074355_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'content' => $this->text(),
            'type' => $this->tinyInteger()->notNull()->defaultValue(1),
            'active' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-test_id-question', 'question', 'test_id', 'test', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
