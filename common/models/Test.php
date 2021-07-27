<?php

namespace common\models;

use common\models\query\QuestionAnswerQuery;
use common\models\query\QuestionQuery;
use common\models\query\TestQuery;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $content
 * @property int $active
 * @property int $number_of_question
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property QuestionAnswer[] $questionAnswers
 * @property Question[] $questions
 */
class Test extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            ['active', 'integer'],
            ['number_of_question', 'integer', 'min' => 1],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'active' => 'Active',
            'number_of_question' => 'Number of question',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[QuestionAnswers]].
     *
     * @return ActiveQuery|QuestionAnswerQuery
     */
    public function getQuestionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class, ['test_id' => 'id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return ActiveQuery|QuestionQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::class, ['test_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestQuery(get_called_class());
    }
}
