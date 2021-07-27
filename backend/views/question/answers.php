<?php
/**
 * User: azam
 * Date: 20/07/21
 * Time: 14:21
 */

/**
 * @var yii\web\View $this
 * @var common\models\Question $question
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use common\models\QuestionAnswer;
use common\widgets\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

?>

<div class="card">
    <div class="card-header">
        <h1>Answers</h1>
    </div>

    <div class="card-body p-0">

        <?php echo GridView::widget([
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'content:ntext',
                'correct:boolean',
                'active:boolean',
                [
                    'class' => ActionColumn::class,
                    'header' => Yii::t('backend', 'Actions'),
                    'urlCreator' => function (string $action, QuestionAnswer $questionAnswer) use ($question) {
                        switch ($action) {
                            case 'view':
                                return Url::to(['question-answer/view', 'id' => $questionAnswer->id, 'question_id' => $question->id]);
                            case 'update':
                                return Url::to(['question-answer/update', 'id' => $questionAnswer->id, 'question_id' => $question->id]);
                            case 'delete':
                                return Url::to(['question-answer/delete', 'id' => $questionAnswer->id, 'question_id' => $question->id]);
                        }
                        return null;
                    }
                ],
            ],
        ]); ?>

    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>

