<?php

namespace app\controllers;

use app\models\NumbersForm;
use app\models\NumbersWorkFlow;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $post = Yii::$app->request->post('NumbersForm');

        if (!empty($post)) {
            $workFlowModel = new NumbersWorkFlow([
                'firstNumber' => $post['firstNumber'],
                'secondNumber' => $post['secondNumber']
            ]);

            $numberOfLuckyNums = $workFlowModel->getNumberOfLuckyNums();
        }

        $formModel = new NumbersForm();
        if ($formModel->load(Yii::$app->request->post())) {
            if (!$formModel->validate()) {
                Yii::$app->session->setFlash('error', "Ошибка в форме!");
            }
        }

        return $this->render('index', [
            'formModel' => $formModel,
            'numberOfLuckyNums' => $numberOfLuckyNums ?? null
        ]);


    }
}
