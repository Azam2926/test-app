<?php

/**
 * @var yii\web\View $this
 * @var common\models\Question $model
 */

$this->title = 'Update Question: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
