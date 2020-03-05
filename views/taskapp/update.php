<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>

<div>
<?php $form = ActiveForm::begin(
[
	'id' => 'task',
	'method' => 'post',
	//'action' => 'create-task',
	'options' => 
	[
		'class' => 'task-form',
	]
]); 
?>

<div class="row">
<div class="form-group col-md-12">
 <?= $form->field($model, 'description', 
 ['inputOptions' => 
 [
 	'class' => 'form-control',
 	'id' => 'inputDesc'
 ]])->textArea(['rows' => '2']); ?>

  </div>

<div class="form-row">
    <div class="form-group col-md-6">


<?= $form->field($model, 'priority',
	['inputOptions' => 
	 [
	 	'class' => 'form-control',
	 	'id' => 'inputPriority'
	 ]]
)->dropDownList([
    '0' => 'Низкий',
    '1' => 'Средний',
    '2'=>'Высокий'
    ]);
?>
    </div>
    <div class="form-group col-md-6">

<?= $form->field($model, 'status',
	['inputOptions' => 
	 [
	 	'class' => 'form-control',
	 	'id' => 'inputStatus'
	 ]]
)->dropDownList([
    '0' => 'Новый',
    '1' => 'В работе',
    '2'=>'Завершено'
    ]);
?>

    </div>
  </div>

 <div class="form-group col-md-12">
<?= $form->field($model,'created_at_formatted',
['inputOptions' => 
	 [
	 	'class' => 'form-control',
	 	'id' => 'inputDate'
	 ]]
)->widget(DatePicker::className(),
['clientOptions' => ['dateFormat' => 'yyyy-MM-dd'],'language' => 'ru','dateFormat' => 'dd.MM.yyyy',]) ?>
 </div>

  <div class="form-group col-md-12 text-right">
      <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
  </div>

</div>

<?php ActiveForm::end(); ?>

</div>