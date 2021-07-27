<?php

/**
 * @var yii\web\View $this
 * @var common\models\QuestionAnswer $model
 * @var common\models\Question $question
 */

$this->title = 'Create Question Answer';
$this->params['breadcrumbs'][] = ['label' => 'Question Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'question' => $question
    ]) ?>

</div>
