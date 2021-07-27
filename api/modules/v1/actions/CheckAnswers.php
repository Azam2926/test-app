<?php
/**
 * User: azam
 * Date: 21/07/21
 * Time: 13:32
 */

namespace api\modules\v1\actions;

use common\models\QuestionAnswer;
use Yii;
use yii\rest\Action;

class CheckAnswers extends Action
{
    public function run(): array
    {
        $corrects = $wrongs = 0;
        foreach (Yii::$app->request->post() as $item) {
            $correctAnswer = $this->getCorrectAnswer($item['question_id']);

            if ($correctAnswer['id'] == $item['answer_id'])
                $corrects++;
            else
                $wrongs++;
        }

        return [
            'score' => sprintf('%d ✅ corrects and %d ❌ wrongs', $corrects, $wrongs)
        ];
    }

    public function getCorrectAnswer($question_id)
    {
        return QuestionAnswer::find()
            ->select('id')
            ->byQuestion($question_id)
            ->correct()
            ->asArray()
            ->one();
    }
}