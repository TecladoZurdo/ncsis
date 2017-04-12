<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Liquidacion */

$this->title = 'Create Liquidacion';
$this->params['breadcrumbs'][] = ['label' => 'Liquidacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <style type="text/css">
body{
	background:khaki;
   
}
</style>
    
</div>
