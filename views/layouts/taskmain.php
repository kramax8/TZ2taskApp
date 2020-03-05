<?php
use yii\helpers\Html;
use app\assets\TaskappAppAsset;
use yii\bootstrap\Modal;
TaskappAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<?= $content; ?>

<footer class="footer"></footer>


<?php
Modal::begin([
    'id'=>'taskcreate',
    'header' => '<h2>Создание/редактирование задачи</h2>',
    //'toggleButton' => ['label' => 'click me'],
]);
?>

<?php
Modal::end();
?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
