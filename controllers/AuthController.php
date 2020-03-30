<?php
/**
 * Created by PhpStorm.
 * User: ecartman
 * Date: 30.03.2020
 * Time: 14:32
 */

namespace app\controllers;


use app\models\LoginForm;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    function d($value=null, $die=1)
    {
        echo 'Debug: <br /><pre>';
        print_r($value);
        echo '</pre>';

        if($die) die;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('/site/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest()
    {
        $this->d(Yii::$app->user);
    }

}