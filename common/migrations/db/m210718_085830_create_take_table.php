<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%take}}`.
 */
class m210718_085830_create_take_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%take}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'test_id' => $this->integer(),
            'status' => $this->tinyInteger(),
            'score' => $this->string(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-user_id-take', 'take', 'user_id', 'user', 'id');
        $this->addForeignKey('fk-test_id-take', 'take', 'test_id', 'test', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%take}}');
    }
}
