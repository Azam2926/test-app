<?php

namespace common\models\query;

use common\models\QuestionAnswer;

/**
 * This is the ActiveQuery class for [[\common\models\QuestionAnswer]].
 *
 * @see \common\models\QuestionAnswer
 */
class QuestionAnswerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return QuestionAnswer[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return QuestionAnswer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function question(int $id): QuestionAnswerQuery
    {
        return $this->andWhere(['question_id' => $id]);
    }

    public function byQuestion($question_id): QuestionAnswerQuery
    {
        return $this->andWhere(['question_id' => $question_id]);
    }

    public function correct(): QuestionAnswerQuery
    {
        return $this->andWhere(['correct' => true]);
    }

}
