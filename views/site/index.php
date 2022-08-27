<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\NumbersForm;

/** @var View $this */
/** @var NumbersForm $formModel */
/** @var int|null $numberOfLuckyNums */

$this->title = 'Счастливые числа';
?>

<?php $form = ActiveForm::begin([
    'id' => 'numbers-form',
    'action' => ['index'],
    'method' => 'post',
    'options' => [
        'class' => 'form-horizontal'
    ]
]); ?>
    <?= $form->field($formModel, 'firstNumber', ['options' => ['style' => 'margin: 10px 0 10px 0']]) ?>
    <?= $form->field($formModel, 'secondNumber', ['options' => ['style' => 'margin: 10px 0 10px 0']]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Посчитать', ['class' => 'btn btn-primary', 'style' => 'margin: 10px 0 10px 0']) ?>
        </div>
    </div>

    <div class="result">
        <p style="margin: 10px 0 10px 0">
            Количество счастливых чисел: <b class="result-number"><?= $numberOfLuckyNums ?? null ?></b>
        </p>
    </div>

<?php ActiveForm::end() ?>


