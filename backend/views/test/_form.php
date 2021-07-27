<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Test $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="test-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>
            <?php echo $form->field($model, 'number_of_question')->textInput(['type' => 'number', 'style' => 'width:20%']) ?>
            <?php echo $form->field($model, 'active')->checkbox(['value' => true]) ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
