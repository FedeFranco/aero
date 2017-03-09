<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Compania */

$this->title = 'Create Compania';
$this->params['breadcrumbs'][] = ['label' => 'Companias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compania-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
