<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\Controller */

$this->title = Yii::t('app', 'Create Controller');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Controllers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="controller-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
