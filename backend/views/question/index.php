<?php

use common\models\Question;
use common\widgets\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'value' => function (Question $model) {
                            return Html::a(StringHelper::truncate($model->test->title, 40), ['test/view', 'id' => $model->test->id]);
                        }
                    ],
                    [
                        'attribute' => 'content:ntext',
                        'format' => 'html',
                        'value' => function (Question $model) {
                            return Html::a(StringHelper::truncate($model->content, 50), ['question/view', 'id' => $model->id]);
                        }
                    ],

                    'type',
                    'active:boolean',
                     'created_at:datetime',
                    // 'updated_at',

                    ['class' => ActionColumn::class],
                ],
            ]); ?>

        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
