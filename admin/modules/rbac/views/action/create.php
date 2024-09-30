<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\Action */

$this->title = Yii::t('app', 'Create Action');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
