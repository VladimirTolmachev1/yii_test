<?php
namespace app\controllers;

use app\models\Bonus;
use app\models\Money;
use app\models\Presents;
use Yii;
use yii\web\Controller;

class GameController extends Controller{

    /**
     * Index action
     *
     * @return string
     */
    public function actionIndex(){
        $this->view->registerJsFile('js/game.js');
        $this->view->registerCssFile('css/game.css');

        $money_amount = (new Money())->getMoneyAmmountByUid(Yii::$app->user->identity->getId());
        $bonus_amount = (new Bonus())->getBousAmmountByUid(Yii::$app->user->identity->getId());

        return $this->render('index', ['money_amount' => $money_amount, 'bonus_amount' => $bonus_amount]);
    }

    /**
     * Save present action
     *
     * @return bool
     */
    public function actionSavePresent(){
        $present_item = new Presents();
        $present_item->uid = Yii::$app->user->identity->getId();
        $present_item->present_name = Yii::$app->request->post('present_name');
        $present_item->status = Yii::$app->request->post('present_status');

        if($present_item->save())
            return true;

        return false;
    }

    /**
     * Save money action
     *
     * @return bool
     */
    public function actionSaveMoney(){
        $money_item = new Money();
        if($money_item->saveRecord(Yii::$app->user->identity->getId(), Yii::$app->request->post('money_count')))
            return true;

        return false;
    }

    /**
     * Save bonus action
     *
     * @return bool
     */
    public function actionSaveBonus(){
        $bonus_item = new Bonus();

        if($bonus_item->saveRecord(Yii::$app->user->identity->getId(), Yii::$app->request->post('bonus_count')))
            return true;

        return false;
    }
}