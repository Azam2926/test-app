<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\QuestionAnswer $model
 * @var common\models\Question $question
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Question Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Update', ['update', 'id' => $model->id, 'question_id' => $question->id], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Delete', ['delete', 'id' => $model->id, 'question_id' => $question->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'test_id',
                        'value' => $model->question->test->title
                    ],
                    [
                        'attribute' => 'question_id',
                        'value' => $model->question->content
                    ],
                    'content:ntext',
                    'correct:boolean',
                    'active:boolean',
                    'created_at:datetime',
                    'updated_at:datetime',

                ],
            ]) ?>
        </div>
    </div>
</div>
