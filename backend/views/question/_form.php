<?php

use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Question $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="question-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <div class="col-6">
                    <?= $form->field($model, 'test_id')->widget(Select2::class, [
                        'data' => $model->testNames,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-6">

                    <?= $form->field($model, 'type')->widget(Select2::class, [
                        'data' => $model->types,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
            </div>

            <?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>
            <?php echo $form->field($model, 'active')->checkbox(['checked' => true]) ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
