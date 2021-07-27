<?php

use common\models\QuestionAnswer;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Question Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer-index">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Create Question Answer', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'id',
                    [
                        'attribute' => 'test_id',
                        'format' => 'html',
                        'value' => function (QuestionAnswer $model) {
                            return Html::a(StringHelper::truncate($model->question->test->title, 40), ['test/view', 'id' => $model->question->id]);
                        }
                    ],
                    [
                        'attribute' => 'question_id',
                        'format' => 'html',
                        'value' => function (QuestionAnswer $model) {
                            return Html::a(StringHelper::truncate($model->question->content, 40), ['question/view', 'id' => $model->question->id]);
                        }
                    ],
                    'content:ntext',
                    'correct:boolean',
                    'active:boolean',
                    'created_at:datetime',
                    // 'updated_at',

                    ['class' => \common\widgets\ActionColumn::class],
                ],
            ]); ?>

        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
