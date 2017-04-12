<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-form">

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <div class="col-lg-4">
            <?= $form->field($model, 'Fun_Codigo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Fun_Cedula')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Fun_Nombres')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Fun_Apellidos')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Fun_FechaIngreso')->textInput() ?>

            <?= $form->field($model, 'Fun_Estado')->dropDownList($model->getListaEstado(), ['prompt'=>'Seleccione']) ?>

            <?= $form->field($model, 'losep')->checkbox(); ?>

            <?php $form->field($model, 'Fun_VacAcumuladas')->textInput() ?>
            <?= Html::activeHiddenInput($model, 'Fun_VacAcumuladas',['value'=>'0']) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>








        <?php ActiveForm::end(); ?>

        <?php
        $url = Url::base() . '@web/js/form_funcionario.js';
        $this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className(), \yii\jui\JuiAsset::className()]]);
        //$this->registerJsFile($url,['depends'=>[\yii\web\JqueryAsset::className()]])
        ?>

    </div>
    

<style type="text/css">
body{
	background:khaki;
   
}
</style>

</div>


