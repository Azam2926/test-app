<?php

/**
 * @var yii\web\View $this
 * @var common\models\Test $model
 */

$this->title = 'Create Test';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
