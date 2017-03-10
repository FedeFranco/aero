<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vuelo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vuelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vuelo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_vuelo',
            'origen.den_aero',
            'destino.den_aero',
            'compania.den_comp',
            'salida',
            'llegada',
            'plazas',
            'precio',
            'usuariosVuelo',
        ],
    ]) ?>

</div>
