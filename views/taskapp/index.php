<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Task Manager';
?> 
<div class="container">
	<h1>Менеджер задач</h1>
	<div class="task">
		<div class="task-head">
<div class="btn-add">
	<a class="btn a-btn create-btn" href="<?= Url::to(['taskapp/create']) ?>">Добавить задачу</a>
</div>
<div class="task-search">

<?php $form = ActiveForm::begin(
[
  'id' => 'task-search',
  'method' => 'get',
  //'action' => 'create-task',
  'options' => 
  [
    'class' => 'task-form',
  ]
]); 
?>
<?= $form->field($model, 'desc', ['inputOptions' => ['placeholder' => 'Поиск']])->textInput(); ?>
          
  <?= Html::submitButton('Искать') ?>
<?php ActiveForm::end(); ?>

</div>
<div class="filter-all">
	<a class="btn f-btn" href=" 
<?= Url::to(['', 'id' => 3]) ?>
  ">Всего - <?= $tCountAll; ?></a>
</div>
<div class="filter-new">
	<a class="btn f-btn" href="
<?= Url::to(['', 'id' => 0]) ?>
  ">Новых - <?= $tCountNew; ?></a>
</div>
<div class="form-progress">
	<a class="btn f-btn" href="
<?= Url::to(['', 'id' => 1]) ?>
  ">В работе - <?= $tCountProg; ?></a>
</div>
<div class="form-finished">
	<a class="btn f-btn" href=" 
<?= Url::to(['', 'id' => 2]) ?>
  ">Заверешено - <?= $tCountFin; ?></a>
</div>
		</div>
		<div class="task-body">
			<div class="table-responsive">
			  <table class="table table-bordered table-striped">
			    <thead>
		        <tr>
		          <th>№</th>
		          <th>Описание</th>
		          <th>Статус</th>
		          <th>Приоритет</th>
		          <th>Плановая дата <br> окончания</th>
		          <th>Фактическая дата <br> окончания</th>
		          <th>STOP</th>
              <th>Действие</th>
		        </tr>
		      </thead>
		      <tbody>
<?php if (isset($tasks) && !empty($tasks)): ?>
<?php $i=1; foreach ($tasks as $task):?>
<tr>
  <th><?= $i; ?></th>
  <td>
<a class="btn a-btn desc-btn" data-id="<?= $task->id ?>" href="<?= Url::to(['taskapp/update', 'id' => $task->id]) ?>">
	<?= $task->description; ?>
</a>
</td>
  <td><?= $sta[$task->status]; ?></td>
  <td><?= $pri[$task->priority]; ?></td>
  <td><?= date("d.m.Y", $task->deadline);?></td>
  <td><?= $d = $task->date_end ? date("d.m.Y", $task->date_end) : '---'; ?></td>
  <td>
    <a class="btn a-btn stop-btn" data-id="<?= $task->id ?>" href="<?= Url::to(['taskapp/taskstop', 'id' => $task->id]) ?>">stop</a>
  </td>
  <td><a class="btn a-btn del-btn" data-id="<?= $task->id ?>" href="<?= Url::to(['taskapp/delete', 'id' => $task->id]) ?>">Удалить</a></td>
</tr>
<?php $i++; endforeach; ?>
<?php else: ?>
	<tr><th colspan="7"><h2>Пока нету задач...</h2></th></tr>

<?php endif; ?>

		      </tbody>
			  </table>
			</div>
		</div>

	</div>
</div>

<!-- ---------------------------------------------------------------------- -->
<?php
$this->registerJs("   
  $('.desc-btn').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    //$('#taskcreate').find('.modal-title').text('id:'+id);
    $('#taskcreate').find('.modal-body').load('/taskapp/update/?id='+id);
    $('#taskcreate').modal('show');
  });
");
$this->registerJs("   
  $('.create-btn').on('click', function(e) {
    e.preventDefault();
    $('#taskcreate').find('.modal-body').load('/taskapp/create');
    $('#taskcreate').modal('show');
  });
");
?>
<!-- ---------------------------------------------------------------------- -->



































<div class="container" style="display: none;">
<div class="task-form">
<form>
    <div class="row">
  <div class="form-group col-md-12">
    <label for="inputDesc">Описание</label>
    <input type="text" class="form-control" id="inputDesc">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPriority">Приоритет</label>
      <select id="inputPriority" class="form-control">
        <option selected>Низкий</option>
        <option>Средний</option>
        <option>Высокий</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputStatus">Статус</label>
      <select id="inputStatus" class="form-control">
        <option selected>Новый</option>
        <option>В работе</option>
        <option>Завершено</option>
      </select>
    </div>
  </div>

   <div class="form-group col-md-12">
    <label for="inputDate">Крайний срок</label>
    <input type="date" class="form-control" id="inputDate">
  </div>

  <div class="form-group col-md-12 text-right">
      <button type="submit" class="btn btn-primary">Сохранить</button>
  </div>
  </div>
</form>
</div>
</div>
