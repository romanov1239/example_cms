<?php

use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Text
 */

$this->title = Yii::t('app', 'Update Text: ', [
        'nameAttribute' => '' . $model->id,
    ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Texts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="text-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
