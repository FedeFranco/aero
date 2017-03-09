<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AeropuertoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aeropuertos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aeropuerto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aeropuerto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_aero',
            'den_aero',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
