<?php

/**
 * @var yii\web\View $this
 * @var common\models\QuestionAnswer $model
 * @var common\models\Question $question
 */

$this->title = 'Update Question Answer: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Question Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-answer-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'question' => $question
    ]) ?>

</div>
