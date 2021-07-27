<?php

/**
 * @var yii\web\View $this
 * @var common\models\Test $model
 */

$this->title = 'Update Test: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
