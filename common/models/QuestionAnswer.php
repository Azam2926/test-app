<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question_answer".
 *
 * @property int $id
 * @property int|null $test_id
 * @property int|null $question_id
 * @property string|null $content
 * @property int $correct
 * @property int $active
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Question $question
 * @property Test $test
 */
class QuestionAnswer extends ActiveRecord
{

    public $isSelected = false;

    public function fields()
    {
        return [
            'id',
            'content',
            'isSelected',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'question_id', 'correct', 'active', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test',
            'question_id' => 'Question',
            'content' => 'Content',
            'correct' => 'Correct',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuestionQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[Test]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TestQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\QuestionAnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QuestionAnswerQuery(get_called_class());
    }
}
