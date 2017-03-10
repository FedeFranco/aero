<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;

$url = Url::to(['reservas/vuelos']);
$urlActual = Url::to(['reservas/create']);
$js = <<<EOT
    $('#reserva-vuel').keyup(function() {
        var q = $('#reserva-vuel').val();
        if (q == '') {
            $('#lib').html('');
        }
        /*if (!isNaN(q)) {
            return;
        }*/
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {
                q: q
            },
            success: function (data, status, event) {
                $('#lib').html(data);
            }
        });
    });
EOT;
$this->registerJs($js);
/* @var $this yii\web\View */
/* @var $model app\models\Reserva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserva-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'vuel')->textInput()?>

    <?= $form->field($model, 'asiento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div id="lib">
</div>
