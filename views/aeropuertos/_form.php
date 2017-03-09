<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aeropuerto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aeropuerto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_aero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'den_aero')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
