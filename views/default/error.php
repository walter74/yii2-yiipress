<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

$css= <<<sss

sss;
?>
<div class="container">
    <div class="jumbotron" style="background-color:rgb(247, 247, 247)">
        <div class="text-center"><img src="<?= Yii::$app->controller->module->yiipress_logo?>"></div>
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <p class="text-center"><?= nl2br(Html::encode($message)) ?></p>
       
    </div>
</div>
    <!---
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        La Pagina chiamata potrebbe essere non pubblica, inesistente o rimossa!
    </p>
  

</div>-->
