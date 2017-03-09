<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vuelo */

$this->title = 'Create Vuelo';
$this->params['breadcrumbs'][] = ['label' => 'Vuelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vuelo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
