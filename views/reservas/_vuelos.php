<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<?php Pjax::begin([
    'enablePushState' => false,
    ]) ?>

<?= \yii\grid\GridView::widget([
    'id' => 'vuelosGrid',
    'dataProvider' => $dataProvider,
    'columns' => [
        'id_vuelo',
        'comp_id',
    ],
    /*'tableOptions' => [
        'class' => 'table table-bordered table-hover',
    ],*/
]) ?>

<?php
    $url = Url::to(['reservas/create']);
    echo <<<EOT
    <script>
  $('#vuelosGrid tr').click(function (event) {
        var target = event.currentTarget;
        if ($(target).children().length > 1) {
            var obj = $(target).children().first();
            numero = $(obj[0]).text();
            window.location.assign('$url' + '?vuelo_id=' + vuelo_id);
        }
    });
    </script>
EOT;
?>

<?php Pjax::end() ?>
