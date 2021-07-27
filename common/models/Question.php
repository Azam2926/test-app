<?php

namespace common\models;

use common\models\query\QuestionQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int|null $test_id
 * @property string|null $content
 * @property int $type
 * @property int $active
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property QuestionAnswer[] $questionAnswers
 * @property Test $test
 * @property array $testNames
 */
class Question extends ActiveRecord
{
    const TYPE_SIMPLE = 1;


    public function behaviors(): array
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['test_id', 'type', 'active', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test',
            'content' => 'Content',
            'type' => 'Type',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[QuestionAnswers]].
     *
     * @return ActiveQuery
     */
    public function getQuestionAnswers(): ActiveQuery
    {
        return $this->hasMany(QuestionAnswer::className(), ['question_id' => 'id'])
            ->andWhere(['active' => true])
            ->orderBy('rand()');
    }

    /**
     * Gets query for [[Test]].
     *
     * @return ActiveQuery
     */
    public function getTest(): ActiveQuery
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * {@inheritdoc}
     * @return QuestionQuery the active query used by this AR class.
     */
    public static function find(): QuestionQuery
    {
        return new QuestionQuery(get_called_class());
    }

    public function getTestNames(): array
    {
        return ArrayHelper::map(Test::find()->all(), 'id', 'title');
    }

    public function getTypes(): array
    {
        return [
            self::TYPE_SIMPLE => 'Simple'
        ];
    }
}
