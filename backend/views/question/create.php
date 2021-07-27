<?php

/**
 * @var yii\web\View $this
 * @var common\models\Question $model
 */

$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
