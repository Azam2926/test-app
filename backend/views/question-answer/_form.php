<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\QuestionAnswer $model
 * @var common\models\Question $question
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="question-answer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'test_id')->hiddenInput(['value' => $question->test_id])->label(false) ?>
            <?php echo $form->field($model, 'question_id')->hiddenInput(['value' => $question->id])->label(false) ?>

            <?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>
            <?php echo $form->field($model, 'correct')->checkbox() ?>
            <?php echo $form->field($model, 'active')->checkbox(['checked' => true]) ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
