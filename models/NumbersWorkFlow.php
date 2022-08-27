<?php

namespace app\models;

use yii\base\Component;

class NumbersWorkFlow extends Component
{
    /** @var int */
    public $firstNumber;

    /** @var int */
    public $secondNumber;

    public function init()
    {
        parent::init();

        if ($this->firstNumber > $this->secondNumber) {
            list($this->firstNumber, $this->secondNumber) = [$this->secondNumber, $this->firstNumber];
        }


    }

    /**
     * Возвращаем количество счастливых чисел
     *
     * @return int
     */
    public function getNumberOfLuckyNums(): int
    {
        return count($this->getLuckyNumbers());
    }

    /**
     * Получаем массив счастливых чисел
     *
     * @return array
     */
    private function getLuckyNumbers(): array
    {
        $luckyNumbers = [];

        for ($i = $this->firstNumber; $i <= $this->secondNumber; $i++) {
            if ($this->checkNumberIsLucky($this->addZeroesToNumber($i))) {
                $luckyNumbers[] = $i;
            }
        }

        return $luckyNumbers;
    }

    /**
     * Проверям, счастливое ли число
     *
     * @param string $currentNumber
     * @return bool
     */
    private function checkNumberIsLucky(string $currentNumber): bool
    {
        $firstSubNumber = substr($currentNumber, 0, 3);
        $secondSubNumber = substr($currentNumber, 3, 3);

        $sumOfDigitsOfFirstNum = $this->addDigitsOfNumber($firstSubNumber);
        $sumOfDigitsOfSecondNum = $this->addDigitsOfNumber($secondSubNumber);

        if ($sumOfDigitsOfFirstNum == $sumOfDigitsOfSecondNum) {
            return true;
        }

        return false;
    }

    /**
     * Суммируем цифры в числе
     *
     * @param string $number
     * @return int
     */
    private function addDigitsOfNumber(string $number): int
    {
        $digits = [];
        $length = strlen($number);
        for ($i = 0; $i < $length; $i++) {
            $digits[] = substr($number, $i, 1);
        }

        $firstSum = array_sum($digits);

        if (strlen($firstSum) > 1) {
            return $this->addDigitsOfNumber($firstSum);
        }
        return $firstSum;
    }

    /**
     * Добавляем нули, чтобы получилось "шестизначное" число
     *
     * @param $number
     * @return string
     */
    private function addZeroesToNumber($number): string
    {
        $length = strlen($number);

        if ($length < 6) {
            for ($i = 0; $i < (6 - $length); $i++) {
                $number = '0' . $number;
            }
        }

        return $number;
    }
}