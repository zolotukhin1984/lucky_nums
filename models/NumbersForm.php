<?php

namespace app\models;

use yii\base\Model;

class NumbersForm extends Model
{
    /** @var int */
    public $firstNumber;

    /** @var int */
    public $secondNumber;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['firstNumber', 'secondNumber'], 'required'],
            [['firstNumber', 'secondNumber'], 'number', 'min' => 1, 'max' => 999999]
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'firstNumber' => 'Первое число',
            'secondNumber' => 'Второе число'
        ];
    }




}